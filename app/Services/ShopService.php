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
        $condition = [
            []
        ];
        $relation = ['productVariant','productCatalogues'];
        $perPage = $request->integer('perpage') ?: 12;
        $shops = $this->shopRepository->pagination(
            $this->paginateSelect(),
            $condition,
            $relation,
            ['id', 'DESC'],
            $perPage,
        );

        // dd($shops);
        return $shops;
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
            'brand_id',
            'user_id',
            'attributeCatalogue',
            'attribute',
            'variant',
            'publish',
            'created_at'
        ];
    }
}
