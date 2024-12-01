<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'Active')->orderby('created_at', 'asc')->limit(8)->get();
        $cheap_products = Product::where('status', 'Active')->orderby('selling_price', 'asc')->limit(8)->get();
        $products = Product::where('status', 'Active')->orderby('created_at', 'asc')->limit(8)->get();
        $latest_products = Product::where('status', 'Active')->orderby('created_at', 'desc')->limit(8)->get();

        return view("customer.index", compact("products", "latest_products", 'cheap_products'));
    }
}
