<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\CategoryType;

class ProductController extends Controller {
    public function index(Request $request): View {
        $sort = $request->query('sort', 'recommended');
        $perPage = (int) $request->query('per_page', 10);
        $search = $request->query('query', '');

        $baseQuery = Product::where('active', true);

        if ($request->filled('main')) {
            $main = $request->main;

            $baseQuery->whereHas('categories', function ($q) use ($main) {
                $q->where('slug', $main);
            });
        }

        $dbMinPrice = (int) floor($baseQuery->min('price'));
        $dbMaxPrice = (int) ceil($baseQuery->max('price'));


        $minPrice = (int) $request->query('min_price', 0);
        $maxPrice = (int) $request->query('max_price', 999999);
        $rating = (int) $request->query('rating', 0);

        if (!in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 10;
        }

        if ($minPrice < $dbMinPrice) {
            $minPrice = $dbMinPrice;
        }

        if ($maxPrice < $minPrice) {
            $maxPrice = $minPrice;
        }

        if ($rating < 0 || $rating > 5) {
            $rating = 0;
        }

        $query = Product::with('images', 'categories')->where('active', true);

        if ($search !== '') {
            /* trim($search) odstrani medzery na zaciatku a na konci, mb_strtolower male pismena (aj s diakritikou), \s+ jeden alebo viac bielych znakov */
            $terms = preg_split('/\s+/', mb_strtolower(trim($search)));

            $query->where(function ($q) use ($terms) {
                foreach ($terms as $index => $term) {
                    $method = $index === 0 ? 'where' : 'orWhere';

                    $q->$method(function ($subQ) use ($term) {
                        $subQ->whereRaw('LOWER(name) LIKE ?', ['%' . $term . '%'])
                            ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $term . '%'])
                            ->orWhereHas('categories', function ($categoryQ) use ($term) {
                                $categoryQ->whereRaw('LOWER(name) LIKE ?', ['%' . $term . '%'])
                                    ->orWhereRaw('LOWER(slug) LIKE ?', ['%' . $term . '%']);
                            });
                    });
                }
            });
        }

        $query->whereBetween('price', [$minPrice, $maxPrice]);

        if ($rating > 0) {
            $query->where('rating', '>=', $rating);
        }

        if ($request->filled('categories')) {
            $categories = $request->categories;

            foreach ($categories as $slug) {
                $query->whereHas('categories', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                });
            }
        }

        if ($request->filled('main')) {
            $main = $request->main;

            $query->whereHas('categories', function ($q) use ($main) {
                $q->where('slug', $main)
                    ->whereHas('categoryType', function ($typeQ) {
                        $typeQ->where('slug', 'main');
                    });
            });
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

        $categoryTypes = CategoryType::with('categories')
            ->where('slug', '!=', 'main')
            ->get();

        return view('products', [
            'products' => $products,
            'sort' => $sort,
            'perPage' => $perPage,
            'search' => $search,
            'categoryTypes' => $categoryTypes,
            'dbMinPrice' => $dbMinPrice,
            'dbMaxPrice' => $dbMaxPrice,
        ]);
    }

    public function home(): View
    {
        $products = Product::with('images')
            ->where('active', true)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('index', compact('products'));
    }

    public function show(int $id): View
    {
        $product = Product::with(['images', 'categories'])->findOrFail($id);

        $categoryIds = $product->categories->pluck('id');

        $similar = Product::with('images')
            ->where('active', true)
            ->where('id', '!=', $id)
            ->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            })
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('product', compact('product', 'similar'));
    }
}
