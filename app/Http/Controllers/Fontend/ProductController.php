<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductCatalogueRepository;

class ProductController extends Controller
{
    protected $productService;
    protected $brandRepository;
    protected $productRepository;
    protected $productCatalogueRepository;

    public function __construct(
        ProductService $productService,
        BrandRepository $brandRepository,
        ProductRepository $productRepository,
        ProductCatalogueRepository $productCatalogueRepository
    ) {
        $this->productService = $productService;
        $this->brandRepository = $brandRepository;
        $this->productRepository = $productRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    
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
        $productSimilars = Product::whereHas('productCatalogues', function ($query) use ($categoryIds) {
            $query->whereIn('product_catalogues.id', $categoryIds);
        })->where('publish', 1)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        $attributeVariant = $this->productService->checkAttributeVariantQuantity($slug);
        return view('fontend.product.detail', compact(
            'brands',
            'product',
            'categories',
            'productSimilars',
            'attributeVariant',
        ));
    }
    
}
