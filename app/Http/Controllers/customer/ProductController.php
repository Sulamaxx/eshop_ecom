<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        Log::info($product);
        if (!$product) {
            abort(404, 'Product not found');
        }

        $relatedProducts = Product::where('brand', $product->brand)->where('id', '!=', $product->id)->get();

        return view('customer.single-product', compact('product', 'relatedProducts'));
    }
}
