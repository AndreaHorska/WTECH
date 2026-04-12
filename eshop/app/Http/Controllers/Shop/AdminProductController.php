<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images', 'categories'])->orderBy('id', 'ASC')->get();
        return view('admin-panel', compact('products'));
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.panel')->with('success', 'Produkt bol zmazaný!');
    }
}