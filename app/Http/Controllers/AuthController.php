<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view("customer.login");
    }
    public function login(Request $request)
    {
        Log::info($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->has('remember');
        Log::info($remember);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember == 1 ? true : false)) {
            if (Auth::check()) {
                $this->migrateSessionCartToDb(Auth::id());
            }
            return redirect()->route('home');
        }

        return back()->with('error', 'These credentials do not match our records.');
    }

    public function showRegistrationForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'contact' => 'nullable|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'contact' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        auth()->login($user);

        if (Auth::check()) {
            $this->migrateSessionCartToDb(Auth::id());
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    protected function migrateSessionCartToDb($userId)
    {
        $sessionCart = Session::get('cart', []);
        foreach ($sessionCart as $item) {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity']
            ]);
        }
        Session::forget('cart');
    }
}
