<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['images', 'categories'])->where('active', true)->orderBy('id', 'DESC')->get();
        return view('admin-panel', compact('products'));
    }

    public function destroy(int $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'active' => false,
        ]);
        return redirect()->route('admin.panel')->with('success', 'Product was deleted!');
    }

    public function edit(int $id)
    {
        $product = Product::with(['images', 'categories'])->findOrFail($id);
        $categoryTypes = \App\Models\CategoryType::with('categories')->get();
        return view('admin-product', compact('product', 'categoryTypes'));
    }

    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);

        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image) {
                    \Storage::disk('public')->delete(str_replace('storage/', '', $image->image_path));
                    $image->delete();
                }
            }
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:80|unique:products,name,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|min:0',
            'quantity' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'categories' => 'array',
            'categories.*' => 'nullable|exists:categories,id',
            'pcs' => 'required|integer|min:1|max:99999',
            'material' => 'required|string|max:100',
            'size' => 'required|string|max:50',
            'weight' => 'required|string|max:30',
            'age' => 'required|string|max:30',
            'country_of_origin' => 'required|string|max:60',
        ]);

        $existingImagesCount = $product->images()->count();
        $deletedImagesCount = count($request->input('delete_images', []));
        $newImagesCount = $request->hasFile('images') ? count($request->file('images')) : 0;

        $finalCount = $existingImagesCount - $deletedImagesCount + $newImagesCount;

        if ($finalCount <= 0) {
            return back()->withErrors(['images' => 'Images are required.'])->withInput();
        }


        $validator->after(function ($validator) use ($request) {

            if (! $this->hasMainCategory(
                $request->input('categories', [])
            )) {
                $validator->errors()->add('categories', 'Select at least one main category.');
            }
        });

        $validator->validate();

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => str_replace(',', '.', $request->price),
            'quantity' => $request->quantity,
            'pcs' => $request->pcs,
            'material' => $request->material,
            'size' => $request->size,
            'weight' => $request->weight,
            'age' => $request->age,
            'country_of_origin' => $request->country_of_origin,
        ]);

        if ($request->filled('categories')) {
            $categories = array_filter($request->categories, fn($id) => !empty($id) && is_numeric($id));
            $product->categories()->sync($categories);
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

    public function create()  /* For adding product */
    {
        $categoryTypes = \App\Models\CategoryType::with('categories')->get();
        return view('admin-product', ['categoryTypes' => $categoryTypes, 'product' => null]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:80|unique:products',
            'description' => 'nullable|string',
            'price' => 'required',
            'quantity' => 'required|integer|min:0',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'categories' => 'array',
            'categories.*' => 'nullable|exists:categories,id',
            'pcs' => 'required|integer|min:1|max:99999',
            'material' => 'required|string|max:100',
            'size' => 'required|string|max:50',
            'weight' => 'required|string|max:30',
            'age' => 'required|string|max:30',
            'country_of_origin' => 'required|string|max:60',
        ]);

        $validator->after(function ($validator) use ($request) {

            if (! $this->hasMainCategory(
                $request->input('categories', [])
            )) {
                $validator->errors()->add('categories', 'Select at least one main category.');
            }
        });

        $validator->validate();

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => (float) str_replace(',', '.', $request->price),
            'quantity' => $request->quantity,

            'pcs' => $request->pcs,
            'material' => $request->material,
            'size' => $request->size,
            'weight' => $request->weight,
            'age' => $request->age,
            'country_of_origin' => $request->country_of_origin,
            'active' => true,
        ]);

        if ($request->filled('categories')) {
            $categories = array_filter($request->categories, fn($id) => !empty($id) && is_numeric($id));
            $product->categories()->sync($categories);
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

    private function hasMainCategory(array $categories): bool
    {
        return Category::whereIn('id', array_filter($categories))
            ->whereHas('categoryType', function ($q) {
                $q->where('name', 'Main');
            })
            ->exists();
    }
}
