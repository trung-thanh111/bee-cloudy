<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\ProductService;
use Illuminate\Http\Request;

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
            ->limit(3)
            ->get(['id', 'name', 'image']);

        return response()->json($products);
    }

    public function searchResult(Request $request, $keyword = '')
    {
        $keyword = $request->input('keyword');

        $products = Product::where('name', $keyword)
        ->where('publish', 1)
        ->with('productCatalogues', 'productVariant', 'productVariant.attributes')
        ->get();

    if ($products->isNotEmpty()) {
        // Nếu có kết quả chính xác, chỉ trả về kết quả đó
        $resultSearchs = new \Illuminate\Pagination\LengthAwarePaginator(
            $products,
            $products->count(),
            9
        );
    } else {
        
        // Nếu không có kết quả chính xác, thực hiện tìm kiếm mở rộng
        $resultSearchs = Product::where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                      ->where('publish', 1);
            })
            ->with('productCatalogues', 'productVariant', 'productVariant.attributes')
            ->paginate(9);
            
    }
        return view('fontend.index.search', compact('resultSearchs','keyword'));
    }
}
