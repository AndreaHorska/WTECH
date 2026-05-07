<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReview(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $newRating = $request->input('rating');

        $product = Product::findOrFail($id);

        $stars = $product->review_count * $product->rating;
        $product->increment('review_count');

        $new_stars = round(($stars + $newRating) / $product->review_count, 1);
        $product->update([
            'rating' => $new_stars
        ]);

        return back()->with('success', 'New review was added!');
    }
}
