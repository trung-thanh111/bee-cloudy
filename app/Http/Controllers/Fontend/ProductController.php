<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $brandRepository;
    protected $productService;
    protected $productCatalogueRepository;

    public function __construct(
        ProductRepository $productRepository,
        BrandRepository $brandRepository,
        ProductService $productService,
        ProductCatalogueRepository $productCatalogueRepository
    ) {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->productService = $productService;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    public function index() {}
    public function detail($slug)
    {
        $product = $this->productRepository->getProductBySlug($slug);
        $product->attribute = $this->productService->getAttribute($product);
        $categories = $this->productCatalogueRepository->allWhere([
            ['publish', '=', 1]
        ]);
        $brands = $this->brandRepository->allWhere([
            ['publish', '=', 1],
        ]);
        $categoryIds = $product->productCatalogues->pluck('id')->toArray();
        $productSimilars = Product::whereHas('productCatalogues', function($query) use ($categoryIds) {
            $query->whereIn('product_catalogues.id', $categoryIds);
        })->where('publish', 1)
          ->where('id', '!=', $product->id)
          ->limit(4)
          ->get();
        return view('fontend.product.detail', compact(
            'product',
            'brands',
            'categories',
            'productSimilars'
        ));
    }
    
}
