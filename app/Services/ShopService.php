<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Repositories\ShopRepository;
use App\Services\Interfaces\ShopServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * interface  UserService
 * @package App\Services
 */

class ShopService implements ShopServiceInterface
{
    protected $shopRepository;
    public function __construct(
        ShopRepository $shopRepository

    ) {
        $this->shopRepository = $shopRepository;
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
            // 'brand_id',
            // 'user_id',
            // 'attributeCatalogue',
            // 'attribute',
            // 'variant',
            'publish',
            'created_at'
        ];
    }
}
