<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductManagementController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product-management', compact('products'));
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'productName' => 'required|string|max:255',
                'productBrand' => 'required|string|max:255',
                'productCostPrice' => 'required|numeric|min:0',
                'productSellingPrice' => 'required|numeric|min:0',
                'productQuantity' => 'required|integer|min:0',
                'productDescription' => 'required|string',
                'imageUpload1' => 'required|image|max:2048',
                'imageUpload2' => 'required|image|max:2048',
                'imageUpload3' => 'required|image|max:2048',
            ]);

            $images = [];
            foreach (['imageUpload1', 'imageUpload2', 'imageUpload3'] as $key) {
                if ($request->hasFile($key)) {
                    $imagePath = $request->file($key)->store('img/product_images', 'public');
                    $images[$key] = $imagePath;
                }
            }

            Product::create([
                'name' => $validatedData['productName'],
                'brand' => $validatedData['productBrand'],
                'cost_price' => $validatedData['productCostPrice'],
                'selling_price' => $validatedData['productSellingPrice'],
                'quantity' => $validatedData['productQuantity'],
                'description' => $validatedData['productDescription'],
                'image1' => $images['imageUpload1'],
                'image2' => $images['imageUpload2'],
                'image3' => $images['imageUpload3'],
            ]);
            return redirect()->back()->with('success', 'Product added successfully!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput()->with('error', 'Failed to add product: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'productName' => 'required|string|max:255',
                'productBrand' => 'required|string|max:255',
                'productCostPrice' => 'required|numeric|min:0',
                'productSellingPrice' => 'required|numeric|min:0',
                'productQuantity' => 'required|integer|min:0',
                'productDescription' => 'required|string',
                'imageUpload4' => 'nullable|image|max:2048',
                'imageUpload5' => 'nullable|image|max:2048',
                'imageUpload6' => 'nullable|image|max:2048',
            ]);

            $product = Product::findOrFail($request->productId);
            $product->name = $validatedData['productName'];
            $product->brand = $validatedData['productBrand'];
            $product->cost_price = $validatedData['productCostPrice'];
            $product->selling_price = $validatedData['productSellingPrice'];
            $product->quantity = $validatedData['productQuantity'];
            $product->description = $validatedData['productDescription'];

            $images = [];
            $imageFields = [
                'imageUpload4' => 'image1',
                'imageUpload5' => 'image2',
                'imageUpload6' => 'image3',
            ];

            foreach ($imageFields as $inputKey => $productKey) {
                if ($request->hasFile($inputKey)) {
                    $existingImagePath = $product->{$productKey};

                    if ($existingImagePath && Storage::disk('public')->exists($existingImagePath)) {
                        Storage::disk('public')->delete($existingImagePath);
                    }

                    $images[$productKey] = $request->file($inputKey)->store('img/product_images', 'public');
                }
            }

            $product->image1 = $images['image1'] ?? $product->image1;
            $product->image2 = $images['image2'] ?? $product->image2;
            $product->image3 = $images['image3'] ?? $product->image3;

            $product->save();

            return  redirect()->back()->with('success', 'Product updated successfully.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->image1 && Storage::disk('public')->exists($product->image1)) {
                Storage::disk('public')->delete($product->image1);
            }
            if ($product->image2 && Storage::disk('public')->exists($product->image2)) {
                Storage::disk('public')->delete($product->image2);
            }
            if ($product->image3 && Storage::disk('public')->exists($product->image3)) {
                Storage::disk('public')->delete($product->image3);
            }

            $product->delete();

            return redirect()->back()->with('success', 'Product deleted successfully');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to deleted product: ' . $e->getMessage());
        }
    }

    public function deactivate($id)
    {
        $this->changeProductStatus($id, "Inactive");
        return redirect()->back()->with('success', 'Product deactivated successfully');
    }

    public function activate($id)
    {
        $this->changeProductStatus($id, "Active");
        return redirect()->back()->with('success', 'Product activated successfully');
    }

    protected function changeProductStatus($id, $sataus)
    {
        $product = Product::findOrFail($id);
        $product->status = $sataus;
        $product->save();
    }
}
