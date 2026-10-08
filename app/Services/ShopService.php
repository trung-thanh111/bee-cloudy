<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\AttributeRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Repositories\ShopRepository;
use App\Services\Interfaces\ShopServiceInterface;
use App\Services\BrandService;

/**
 * interface  UserService
 * @package App\Services
 */

class ShopService implements ShopServiceInterface
{
    protected $shopRepository;
    protected $brandService;
    protected $attributeRepository;
    protected $productCatalogueRepository;
    public function __construct(
        ShopRepository $shopRepository,
        ProductCatalogueRepository $productCatalogueRepository,
        BrandService $brandService,
        AttributeRepository $attributeRepository,

    ) {
        $this->shopRepository = $shopRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->brandService = $brandService;
        $this->attributeRepository = $attributeRepository;
    }

    public function all()
    {
        return $this->shopRepository->all();
    }

    public function paginate($request)
    {
        // Điều kiện cơ bản
        $condition = [
            'where' => [
                ['publish', '!=', 0],
            ]
        ];
        $relation = ['productVariant', 'productCatalogues', 'productVariant.attributes'];
        $perPage = $request->integer('perpage') ?: 9;
        $orderBy = ['id', 'DESC'];

        $sort = $request->query('sort');
        switch ($sort) {
            case 'price_high':
                $orderBy = ['price', 'DESC'];
                break;
            case 'price_low':
                $orderBy = ['price', 'ASC'];
                break;
            case 'newest':
                $orderBy = ['created_at', 'DESC'];
                break;
            case 'oldest':
                $orderBy = ['created_at', 'ASC'];
                break;
            case 'name_asc':
                $orderBy = ['name', 'ASC'];
                break;
            case 'name_desc':
                $orderBy = ['name', 'DESC'];
                break;
        }

        $productShops = $this->shopRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            $orderBy,
            $perPage
        );

        return $productShops;
    }
    public function productShopNews()
    {
        return $this->shopRepository->getLimitOrder(
            ['productVariant', 'productCatalogues', 'productVariant.attributes'],
            [
                ['publish', '!=', 0],
            ],
            [
                ['created_at', 'asc']
            ],
            8
        );
    }
    public function productShopPriceMins()
    {
        return $this->shopRepository->getLimitOrder(
            ['productVariant', 'productCatalogues', 'productVariant.attributes'],
            [
                ['publish', '!=', 0],
            ],
            [
                ['price', 'asc']
            ],
            8
        );
    }

    public function productFilter($request)
    {
        $payload = $request->only('brand', 'category', 'size', 'color', 'price');
        $query = Product::query();

        // Filter theo thương hiệu
        if (!empty($payload['brand'])) {
            $query->whereHas('brands', function ($q) use ($payload) {
                $q->where('slug', $payload['brand']);
            });
        }

        // Filter theo danh mục
        if (!empty($payload['category'])) {
            $query->whereHas('productCatalogues', function ($q) use ($payload) {
                $q->where('slug', $payload['category']);
            });
        }

        // Filter theo size
        // if (!empty($payload['size'])) {
        //     $query->whereHas('sizes', function($q) use ($payload) {
        //         $q->where('slug', $payload['size']);
        //     });
        // }

        // // Filter theo màu sắc  
        // if (!empty($payload['color'])) {
        //     $query->whereHas('colors', function($q) use ($payload) {
        //         $q->where('slug', $payload['color']);
        //     });
        // }

        // Filter theo khoảng giá
        if (!empty($payload['price'])) {
            $priceRange = explode('-', $payload['price']);
            $minPrice = $priceRange[0];
            $maxPrice = $priceRange[1];
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }
        


        // Lấy kết quả
        $products = $query->get();

        return $products;
    }

    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'image',
            'slug',
            'short_desc',
            'description',
            'info',
            'price',
            'del',
            'sku',
            'publish',
            'created_at'
        ];
    }
}
