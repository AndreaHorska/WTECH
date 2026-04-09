<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller {
    public function index(Request $request): View {
        $sort = $request->query('sort', 'recommended');
        $perPage = (int) $request->query('per_page', 10);
        $search = $request->query('query', '');
        $minPrice = (int) $request->query('min_price', 0);
        $maxPrice = (int) $request->query('max_price', 999999);
        $rating = (int) $request->query('rating', 0);

        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        if ($minPrice < 0) {
            $minPrice = 0;
        }

        if ($maxPrice < $minPrice) {
            $maxPrice = $minPrice;
        }

        if ($rating < 0 || $rating > 5) {
            $rating = 0;
        }

        $query = Product::with('images')->where('active', true);

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $query->whereBetween('price', [$minPrice, $maxPrice]);

        if ($rating > 0) {
            $query->where('rating', '>=', $rating);
        }

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'popular':
                $query->where('review_count', '>=', 5)
                    ->orderBy('rating', 'desc')
                    ->orderBy('review_count', 'desc');
                break;

            case 'recommended':
            default:
                $query->where('quantity', '>=', 0)
                    ->orderBy('id', 'desc');
                break;
        }

        $products = $query->paginate($perPage)->withQueryString();

        return view('products', [
            'products' => $products,
            'sort' => $sort,
            'perPage' => $perPage,
            'search' => $search,
        ]);
    }
}
