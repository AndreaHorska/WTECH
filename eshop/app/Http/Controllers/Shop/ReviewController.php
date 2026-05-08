<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReview(Request $request, $id)
    {
        if (!auth()->check()) {
            return back()->with('error', 'You must be logged in to add a review.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $product = Product::findOrFail($id);

        $alreadyReviewed = Review::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        $stars = $product->review_count * $product->rating;

        if ($alreadyReviewed) {     // Da sa lahko odstranit a zakaznik bude vediet pridat viac recenzii
            $stars = $stars - $alreadyReviewed->rating + $request->rating;

            $new_stars = round($stars / $product->review_count, 1);
            $product->update(['rating' => $new_stars]);

            $alreadyReviewed->update(['rating' => $request->rating]);
            return back()->with('warning', 'Your last review updated!');
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
            'rating' => $request->rating,
        ]);

        $product->increment('review_count');
        $new_stars = round(($stars + $request->rating) / $product->review_count, 1);
        $product->update(['rating' => $new_stars]);

        return back()->with('success', 'Review added!');
    }
}
