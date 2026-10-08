<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\AttributeRepository;
use App\Repositories\BrandRepository;
use App\Repositories\PostCatalogueRepository;
use App\Repositories\ShopRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Services\ShopService;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    protected $brandRepository;
    protected $attributeRepository;
    protected $shopRepository;
    protected $shopService;
    protected $productCatalogueRepository;
    protected $postCatalogueRepository;

    public function __construct(
        ShopService $shopService,
        ProductCatalogueRepository $productCatalogueRepository,
        PostCatalogueRepository $postCatalogueRepository,
        ShopRepository $shopRepository,
        AttributeRepository $attributeRepository,
        BrandRepository $brandRepository,
    ) {
        $this->shopRepository = $shopRepository;
        $this->shopService = $shopService;
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->attributeRepository = $attributeRepository;
        $this->brandRepository = $brandRepository;
    }
    public function index(Request $request){
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $postCategories = $this->postCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $productShops = $this->shopService->paginate($request);
        $productShopNews = $this->shopService->productShopNews();
        $productShopPriceMins = $this->shopService->productShopPriceMins(); 
        // -- // lọc 
        $brandFilters = $this->brandRepository->allWhere([
            ['publish', 1]
        ]);
        $attributeColors = $this->attributeRepository->allWhere([
            ['publish', 1],
            ['attribute_catalogue_id', 1]
        ]);
        $attributeSizes = $this->attributeRepository->allWhere([
            ['publish', 1],
            ['attribute_catalogue_id', 2]
        ]);
        $productFilter = $this->shopService->productFilter($request);
        $brands = $this->brandRepository->allWhere([
            ['publish', '=', 1],
        ]);
        // -- //
        return view('fontend.product.shop', compact(
            'productShops',
            'productCatalogues',
            'postCategories',
            'productShopNews',
            'productShopPriceMins',
            'brandFilters',
            'attributeColors',
            'attributeSizes',
            'productFilter',
            'brands',
        ));
    }
    public function productIncategory($id = 0)
    {
        $category = $this->productCatalogueRepository->findById($id, ['childrenReference']);
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1],
            ['id', '!=', $category->id],
        ]);
        $categoryIds = collect([$id]); // mảng id của danh mục chính và con 
        if ($category->childrenReference->count() > 0) {
            $categoryIds = $categoryIds->merge($category->childrenReference->pluck('id'));
        }

        $productInCategories = Product::whereHas('productCatalogues', function ($query) use ($categoryIds) {
            $query->whereIn('product_catalogues.id', $categoryIds);
        })
            ->where('publish', 1)
            ->paginate(9);
        return view('fontend.product.category', compact(
            'category',
            'productInCategories',
            'productCatalogues',
        ));
    }
    
}
