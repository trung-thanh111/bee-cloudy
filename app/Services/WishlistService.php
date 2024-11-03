<?php

namespace App\Services;

use App\Models\ProductVariant;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
use App\Repositories\WishlistRepository;
use App\Services\Interfaces\WishlistServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * interface  UserService
 * @package App\Services
 */

class WishlistService implements WishlistServiceInterface
{
    protected $wishlistRepository;
    protected $productRepository;
    protected $productVariantRepository;
    public function __construct(
        ProductRepository $productRepository,
        ProductVariantRepository $productVariantRepository,
        WishlistRepository $wishlistRepository,
    ) {
        $this->wishlistRepository = $wishlistRepository;
        $this->productRepository = $productRepository;
        $this->productVariantRepository = $productVariantRepository;
    }

    public function paginate($request)
    {
        $condition = [
            'where' => [
                ['user_id', '=',  Auth::id()]
            ]
        ];
        $relation = ['products', 'products.productCatalogues', 'productVariants'];
        $orderBy = ['id', 'asc'];
        $perPage = 12;
        $wishlists = $this->wishlistRepository->pagination(
            ['*'],
            $condition,
            $relation,
            $orderBy,
            $perPage,
        );
        return $wishlists;
    }



    public function toggle($request, $userId, $productId, $variantId)
    {
        DB::beginTransaction();
        try {
            $userId = Auth::id();
            $productId = $request->input('product_id');
            $variantId = $request->input('product_variant_id');
            // dd($userId, $productId, $variantId);
            // Tìm kiếm bản ghi (giới hạn 1 bản ghi thay vì Collection)
            $wishlist = $this->wishlistRepository->findByUserProductVariant($userId, $productId, $variantId);

            if ($wishlist) {
                $wishlist->forceDelete();
                DB::commit();  // Commit tại đây sau khi xóa
                return [
                    'code' => 10, 
                    'message' => 'Đã xóa yêu thích.',
                    'redirect' => 'back'
                ];
            } else {
                // Nếu không tồn tại -> Thêm mới
                $this->wishlistRepository->create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'product_variant_id' => $variantId,
                ]);
                DB::commit(); 
                return ['code' => 10,
                 'message' => 'Đã thêm vào yêu thích.',
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return ['code' => 11, 'message' => 'Có lỗi xảy ra: ' . $e->getMessage()];
        }
    }
}
