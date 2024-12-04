<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckOutController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $exist_addresses = BillingAddress::where('user_id', Auth::user()->id)->get();
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->count() == 0) {
            return redirect()->route('shop')->with('error', 'Please add product to cart');
        } else {
            return view('customer.checkout', compact('cartItems', 'exist_addresses'));
        }
    }

    public function submitOrder(Request $request)
    {
        Log::info($request->all());
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address_line1' => 'required',
                'address_line2' => 'required',
                'city' => 'required',
                'district' => 'required',
                'zip' => 'required',
                'payment_method' => 'required',
            ]);

            if ($request->address_id == null) {
                $billingAddress = BillingAddress::create([
                    'user_id' => Auth::id(),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address_line1' => $request->address_line1,
                    'address_line2' => $request->address_line2,
                    'city' => $request->city,
                    'district' => $request->district,
                    'zip' => $request->zip,
                ]);
            }

            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->back()->withErrors(['cart' => 'Your cart is empty!']);
            }

            try {
                DB::beginTransaction();

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'billing_address_id' => $request->address_id == null ? $billingAddress->id : $request->address_id,
                    'total_amount' => ($cartItems->sum(fn($item) => $item->product->selling_price * $item->quantity) + 30),
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'payment_method' => $request->payment_method,
                ]);

                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'selling_price' => $cartItem->product->selling_price,
                        'quantity' => $cartItem->quantity,
                    ]);
                }

                Cart::where('user_id', Auth::id())->delete();
                DB::commit();

                if ($request->payment_method == 'card') {
                    return redirect()->route('payment.process', ['id' => $order->id]);
                }

                return redirect()->route('order.summary', ['id' => $order->id])->with('success', 'Your order has been placed.');
            } catch (Exception $e) {

                DB::rollBack();
                Log::error('Order processing failed: ' . $e->getMessage());
                return redirect()->back()->withInput()->with(['error' => 'Failed to process your order. Please try again later.']);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Failed to process: ' . $e->getMessage());
        }
    }

    public function processPayment($id)
    {
        try {
            // Payment gateway process  

            $order = Order::find($id);
            $order->payment_status = 'completed';
            $order->order_status = 'processed';
            $order->save();

            Log::info($order);

            return redirect()->route('order.summary', ['id' => $order->id])->with('success', 'Your order has been placed with card payment.');
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function invoice($id)
    {
        $order = Order::with('billing_address')->where('id', $id)->where('user_id', Auth::id())->get();
        $order_items = OrderItem::with('product:id,name')->where('order_id', $id)->get();
        Log::info($order);
        Log::info($order_items);
        return view("customer.confirmation", compact('order', 'order_items'));
    }
}
