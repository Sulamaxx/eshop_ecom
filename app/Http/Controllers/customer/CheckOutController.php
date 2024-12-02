<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function checkout()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->count() == 0) {
            return redirect()->route('shop')->with('error', 'Please add product to cart');
        } else {
            return view('customer.checkout', compact('cartItems'));
        }
    }



    public function invoice()
    {
        return view("customer.confirmation");
    }
}
