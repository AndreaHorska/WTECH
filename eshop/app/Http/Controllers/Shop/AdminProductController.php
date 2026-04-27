<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

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
        return redirect()->route('admin.panel')->with('success', 'Product was deleted!');
    }

    public function edit(int $id)
    {
        $product = Product::with(['images', 'categories'])->findOrFail($id);
        $categoryTypes = \App\Models\CategoryType::with('categories')->get();
        return view('admin-edit-product', compact('product', 'categoryTypes'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:80|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => str_replace(',', '.', $request->price),
            'quantity' => $request->quantity,
            'material' => $request->material,
            'size' => $request->size,
            'weight' => $request->weight,
            'age' => $request->age,
            'country_of_origin' => $request->country_of_origin,
        ]);

        if ($request->filled('categories')) {
            $product->categories()->sync($request->categories);
        } else {
            $product->categories()->detach();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'storage/products/' . $filename,
                ]);
            }
        }

        return redirect()->route('admin.panel')->with('success', 'Product was updated!');
    }

    public function create()    /* For adding product */
    {
        $categoryTypes = \App\Models\CategoryType::with('categories')->get();
        return view('admin-add-product', compact('categoryTypes'));
    }

    public function store(Request $request) /* Add new product */
    {
        $request->validate([
            'name' => 'required|string|max:80|unique:products',
            'description' => 'nullable|string',
            'price' => 'required',
            'quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float) str_replace(',', '.', $request->price),
            'quantity' => $request->quantity,
            'material' => $request->material,
            'size' => $request->size,
            'weight' => $request->weight,
            'age' => $request->age,
            'country_of_origin' => $request->country_of_origin,
            'active' => true,
        ]);

        if ($request->filled('categories')) {
            $product->categories()->sync($request->categories);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'storage/products/' . $filename,
                ]);
            }
        }

        return redirect()->route('admin.panel')->with('success', 'Product was added!');
    }
}