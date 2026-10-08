<?php

namespace App\Http\Controllers\Ajax;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    protected $post;
    protected $productService;
    protected $productVariant;

    public function construct(
        ProductService $productService,

    ) {
        $this->productService = $productService;
    }
    public function suggestion(Request $request)
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            return response()->json(['không có kết quả tìm kiếm!']);
        }

        $products = Product::where('name', 'LIKE', "%{$keyword}%")
            ->get(['id', 'name', 'image']);

        return response()->json($products);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        
        $type = $request->input('type');
        if ($type === 'product') {
            $results = Product::where('name', 'LIKE', "%{$keyword}%")
                ->where('publish', 1)
                ->with('productCatalogues', 'productVariant', 'productVariant.attributes')
                ->paginate(9);
            if ($results->isNotEmpty()) {
                // Nếu có kết quả chính xác
                $resultSearchs = new \Illuminate\Pagination\LengthAwarePaginator(
                    $results,
                    $results->count(),
                    12
                );
            } else {
                $resultSearchs = Product::where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->where('publish', 1);
                })
                    ->with('productCatalogues', 'productVariant', 'productVariant.attributes')
                    ->paginate(12);
            }
        } elseif ($type === 'post') {
            $results = Post::where('name', 'LIKE', "%{$keyword}%")
                ->where('publish', 1)
                ->with('users')
                ->paginate(12);
            if ($results->isNotEmpty()) {
                // Nếu có kết quả chính xác
                $resultSearchs = new \Illuminate\Pagination\LengthAwarePaginator(
                    $results,
                    $results->count(),
                    12
                );
            } else {
                $resultPostSearchs = Post::where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                        ->where('publish', 1);
                })
                    ->with('users')
                    ->paginate(9);
            }
        } else {
            $results = collect([]); 
        }

        return view('fontend.index.search', compact('results', 'keyword', 'type'));
    }
}
