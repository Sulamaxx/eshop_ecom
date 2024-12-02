<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ShopController extends Controller
{

    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $query = Product::query();

        if ($request->has('brand')) {
            $query->where('brand', $request->brand);
        }

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('selling_price', [$request->price_min, $request->price_max]);
        }

        $products = $query->where('status', 'Active')->paginate(12);

        $brands = Product::select('brand')->distinct()->pluck('brand');

        return view('customer.shop', compact('products', 'brands'));
    }
}
