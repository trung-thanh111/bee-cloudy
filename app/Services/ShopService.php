<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\AttributeRepository;
use App\Repositories\ProductCatalogueRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ShopRepository;
use App\Services\Interfaces\ShopServiceInterface;
use App\Services\BrandService;

/**
 * interface  UserService
 * @package App\Services
 */

class ShopService implements ShopServiceInterface
{
    protected $brandService;
    protected $shopRepository;
    protected $productRepository;
    protected $attributeRepository;
    protected $productCatalogueRepository;
    public function __construct(
        BrandService $brandService,
        ShopRepository $shopRepository,
        ProductRepository $productRepository,
        AttributeRepository $attributeRepository,
        ProductCatalogueRepository $productCatalogueRepository,

    ) {
        $this->brandService = $brandService;
        $this->shopRepository = $shopRepository;
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
        $this->productCatalogueRepository = $productCatalogueRepository;
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
                ['created_at', 'desc']
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
        $payload = $request->only('brand', 'category', 'size', 'color', 'price', 'sort');
        $query = Product::with('productVariant', 'productCatalogues', 'productVariant.attributes');

        if (isset($payload['brand']) && !empty($payload['brand'])) {
            $query->whereHas('brands', function ($q) use ($payload) {
                $q->where('slug', $payload['brand']);
            });
        }
        if (isset($payload['category']) && !empty($payload['category'])) {
            $query->whereHas('productCatalogues', function ($q) use ($payload) {
                $q->where('slug', $payload['category']);
            });
        }

        if (isset($payload['price']) && !empty($payload['price'])) {
            $price = explode('-', $payload['price']);
            $minPrice = $price[0];
            $maxPrice = $price[1];
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }
        $query->whereHas('productVariant', function ($variantQuery) use ($payload) {
            if (!empty($payload['size'])) {
                // SUBSTRING_INDEX là hàm trong sql để cắt chuỗi dựa trên ký tự phân cách 
                $variantQuery->whereRaw('SUBSTRING_INDEX(code, ",", 1) = ?', [$payload['size']]);
            }
        
            if (!empty($payload['color'])) {
                $variantQuery->where(function ($query) use ($payload) {
                    // Kiểm tra xem code có chứa dấu phẩy hay không
                    $query->whereRaw('code LIKE "%,%"')
                          ->whereRaw('SUBSTRING_INDEX(code, ",", -1) = ?', [$payload['color']]);
                });
            }
        });
        if (!empty($payload['sort'])) {
            switch ($payload['sort']) {
                case 'price_high':
                    $query->orderBy('price', 'DESC');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'ASC');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'DESC');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'ASC');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'ASC');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'DESC');
                    break;
            }
        } else {
            $query->orderBy('id', 'DESC');
        }

        $products = $query->paginate(9);
        return $products;
    }

    private function paginateSelect()
    {
        return [
            'id',
            'name',
            'slug',
            'image',
            'album',
            'info',
            'description',
            'brand_id',
            'is_hot',
            'price',
            'del',
            'instock',
            'sku',
            'publish',
        ];
    }
}
