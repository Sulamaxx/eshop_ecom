<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCartSingle($id, $qty)
    {
        try {
            $this->addToCartProcessor($id, $qty);
            return response()->json(['success' => true, 'message' => 'Product added to cart']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error', $e->getMessage()]);
        }
    }

    public function addToCart(Request $request, $id)
    {
        try {
            $this->addToCartProcessor($id, $request->input('quantity', 1));
            return redirect()->back()->with('success', 'Product added to cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    protected function addToCartProcessor($id, $qty)
    {
        if (Auth::check()) {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            $cart = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            if ($cart) {
                $cart->quantity += $qty;
                $cart->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quantity' => $qty,
                ]);
            }
        } else {
            $this->cartService->addToSessionCart($id, $qty);
        }
    }

    public function updateCart(Request $request)
    {
        try {
            if (Auth::check()) {
                $cart = Cart::find($request->input('id'));
                if ($cart && $cart->user_id == Auth::id()) {
                    $cart->quantity = $request->input('quantity');
                    $cart->save();
                }
            } else {
                $this->cartService->updateSessionCart($request->input('id'), $request->input('quantity'));
            }
            return response()->json(['success' => true, 'message' => 'Product updated to cart']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error', $e->getMessage()]);
        }
    }

    public function removeFromCart($id)
    {
        try {
            if (Auth::check()) {
                $cart = Cart::find($id);
                if ($cart && $cart->user_id == Auth::id()) {
                    $cart->delete();
                }
            } else {
                $this->cartService->removeFromSessionCart($id);
            }
            return response()->json(['success' => true, 'message' => 'Product deleted fron cart']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error', $e->getMessage()]);
        }
    }

    public function viewCart()
    {
        try {
            if (Auth::check()) {
                $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
            } else {
                $cartItems = $this->cartService->getSessionCart();
            }
            return view('customer.cart', compact('cartItems'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
