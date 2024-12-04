<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $product_rates = ProductRating::where('product_id', $product->id)->get();
        $own_rate = ProductRating::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->get();
        $relatedProducts = Product::where('brand', $product->brand)->where('id', '!=', $product->id)->get();
        Log::info($own_rate);
        Log::info($product_rates);
        return view('customer.single-product', compact('product', 'relatedProducts', 'product_rates', 'own_rate'));
    }

    public function rateProduct(Request $request)
    {

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $userId = Auth::id();

        $rating = ProductRating::updateOrCreate(
            ['product_id' => $request->product_id, 'user_id' => $userId],
            ['rating' => $request->rating]
        );

        return response()->json(['success' => true, 'rating' => $rating], 200);
    }
}
