<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::query()->get();

        return ProductResource::collection($products);
    }

    public function store(Request $request) {
        //dd($request->categories);
        $product = Product::create(
            [
                'name' => $request->name,
                'qty' => $request->qty,
            ]
        );

        $product->categories()->attach($request->categories);

        return response()->json($product);
    }

    public function show($id) {
        $product = Product::with('categories')->findOrFail($id);
        return ProductResource::make($product);
    }

    public function update(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        $product->categories()->sync($request->categories);

        return response()->json($product);
    }

    public function destroy($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'ürün bulunamadı'], 404);
        }

        $product->delete();

        return response()->json(['message' => $product->name . ' isimli ürün silindi']);
    }
}
