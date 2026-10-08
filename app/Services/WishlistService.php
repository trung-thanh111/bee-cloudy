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
            $userId = $userId ?: Auth::id();
            $productId = $productId ?: $request->input('product_id');
            $variantId = $variantId ?: $request->input('product_variant_id');

            $wishlist = $this->wishlistRepository->findByUserProductVariant($userId, $productId, $variantId);

            if ($wishlist) {
                $wishlist->delete();
                flash()->success('Đã xóa yêu thích.');
            } else {
                $this->wishlistRepository->create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'product_variant_id' => $variantId,
                ]);
                flash()->success('Đã thêm vào yêu thích.');
            }

            DB::commit();
            return response()->json(['code' => 10, 'message' => 'Success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['code' => 0, 'message' => $e->getMessage()], 500);
        }
    }



    //     public function update(Request $request)
    //     {
    //         DB::beginTransaction();
    //         try {
    //             $cart = $this->wishlistRepository->all(
    //                 ['cartItems', 'cartItems.productVariants', 'cartItems.productVariants.attributes', 'cartItems.products'],
    //                 [
    //                     ['user_id', Auth::id()],
    //                     ]
    //                 );
    //                 if ($cart) {
    //                     // loop qua các item trong giỏ hàng 
    //                     foreach ($cart->wishlistItems as $item) {
    //                         $payload = $request->input();

    //                         // product_variant_id tồn tại trong payload (request)
    //                         if ($payload['product_variant_id'] && $item->productVariants && $item->productVariants->id == $payload['product_variant_id']) {
    //                             // Cập nhật
    //                             $quantity = $payload['quantity'];
    //                             $item->update(['quantity' => $quantity]);

    //                         } elseif ($payload['product_id'] && $item->products && $item->products->id == $payload['product_id']) {
    //                             $quantity = $payload['quantity'];
    //                             $item->update(['quantity' => $quantity]);
    //                         }
    //                     }
    //                 }

    //             DB::commit();
    //             return true;
    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //             echo $e->getMessage();
    //             return false;
    //         }
    //     }
    //     public function destroy(Request $request)
    //     {
    //         DB::beginTransaction();
    //         try {
    //             $payload = $request->input();

    //             $id = $payload['product_id'] ? $payload['product_id'] : $payload['product_variant_id'];
    //             // lấy ra item dựa trên mối quan hệ                         // closure
    //             $cartItem = CartItem::whereHas('productVariants', function($query) use ($id) {
    //                 $query->where('product_variant_id', $id);
    //             })
    //             ->orWhereHas('products', function($query) use ($id) {
    //                 $query->where('product_id', $id);
    //             })
    //             ->first();
    //             if ($cartItem) {
    //                 $cartItem->delete();
    //             }
    //             DB::commit();
    //             return true;
    //         } catch (\Exception $e) {
    //             DB::rollBack();
    //             echo $e->getMessage();
    //             return false;
    //         }
    //     }
    //     public function clear(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $cartId = $request->input('cart_id');
    //         $cart = Cart::where('user_id', Auth::id())
    //                       ->first();
    //         $cart->delete();
    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return false;
    //     }
    // }
}
