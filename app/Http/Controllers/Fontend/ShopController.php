<?php

namespace App\Http\Controllers\Fontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ShopService;
use App\Services\BrandService;
use App\Http\Controllers\Controller;
use App\Repositories\ShopRepository;
use App\Repositories\BrandRepository;
use App\Repositories\BannerRepository;
use App\Repositories\AttributeRepository;
use App\Repositories\PostCatalogueRepository;
use App\Repositories\ProductCatalogueRepository;


class ShopController extends Controller
{
    protected $shopService;
    protected $brandService;
    protected $shopRepository;
    protected $brandRepository;
    protected $bannerRepository;
    protected $attributeRepository;
    protected $postCatalogueRepository;
    protected $productCatalogueRepository;

    public function __construct(
        ShopService $shopService,
        BrandService $brandService,
        ShopRepository $shopRepository,
        BrandRepository $brandRepository,
        BannerRepository $bannerRepository,
        AttributeRepository $attributeRepository,
        PostCatalogueRepository $postCatalogueRepository,
        ProductCatalogueRepository $productCatalogueRepository,
    ) {
        $this->shopService = $shopService;
        $this->brandService = $brandService;
        $this->shopRepository = $shopRepository;
        $this->brandRepository = $brandRepository;
        $this->bannerRepository = $bannerRepository;
        $this->attributeRepository = $attributeRepository;
        $this->postCatalogueRepository = $postCatalogueRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
    }
    public function index(Request $request)
    {
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $postCategories = $this->postCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
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
        $brands = $this->brandRepository->allWhere([
            ['publish', '=', 1],
        ]);
        // -- //
        if ($request->hasAny(['brand', 'category', 'size', 'color', 'price'])) {
            $productShops = $this->shopService->productFilter($request);
        } else {
            $productShops = $this->shopService->paginate($request);
        }
        $bannerShop = $this->bannerRepository->allWhere([
            ['publish', 1],
            ['location', 2]
        ]);

        return view('fontend.product.shop', compact(
            'brands',
            'bannerShop',
            'brandFilters',
            'productShops',
            'postCategories',
            'attributeSizes',
            'productShopNews',
            'attributeColors',
            'productCatalogues',
            'productShopPriceMins',
        ));
    }
    public function productIncategory($id = 0, Request $request)
    {
        $category = $this->productCatalogueRepository->findById($id, ['childrenReference']);
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1],
            ['id', '!=', $category->id],
        ]);
        $brandAll = $this->brandRepository->allWhere([
            ['publish', 1]
        ]);
        $postCategories = $this->postCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $productShopNews = $this->shopService->productShopNews();
        $productShopPriceMins = $this->shopService->productShopPriceMins();
        // --//
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
        $categoryIds = collect([$id]); // mảng id của danh mục chính và con 
        if ($category->childrenReference->count() > 0) {
            $categoryIds = $categoryIds->merge($category->childrenReference->pluck('id'));
        }
        if ($request->hasAny(['brand', 'category', 'size', 'color', 'price'])) {
            $productInCategories = $this->shopService->productFilter($request);
        } else {
            $productInCategories = Product::whereHas('productCatalogues', function ($query) use ($categoryIds) {
                $query->whereIn('product_catalogues.id', $categoryIds);
            })
                ->where('publish', 1)
                ->paginate(9);
        }
        $bannerShop = $this->bannerRepository->allWhere([
            ['publish', 1],
            ['location', 2]
        ]);
        return view('fontend.product.category', compact(
            'category',
            'brandAll',
            'bannerShop',
            'brandFilters',
            'postCategories',
            'attributeSizes',
            'attributeColors',
            'productShopNews',
            'productCatalogues',
            'productInCategories',
            'productShopPriceMins',
        ));
    }
    public function productInBrand($id = 0, Request $request)
    {
        $brand = $this->brandRepository->findById($id, []);
        $brandAll = $this->brandRepository->allWhere([
            ['publish', 1],
            ['id', '!=', $brand->id],
        ]);
        $productCatalogues = $this->productCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
        $postCategories = $this->postCatalogueRepository->allWhere([
            ['publish', 1]
        ]);
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
        $productShopNews = $this->shopService->productShopNews();
        $productShopPriceMins = $this->shopService->productShopPriceMins();
        //--//
        if ($request->hasAny(['brand', 'category', 'size', 'color', 'price'])) {
            $productInBrands = $this->shopService->productFilter($request);
        } else {
            $productInBrands = Product::where('brand_id', $brand->id)
                ->where('publish', 1)
                ->paginate(9);
        }
        return view('fontend.product.brand', compact(
            'brand',
            'brandAll',
            'brandFilters',
            'attributeSizes',
            'attributeColors',
            'postCategories',
            'productShopNews',
            'productInBrands',
            'productCatalogues',
            'productShopPriceMins',
        ));
    }
}
