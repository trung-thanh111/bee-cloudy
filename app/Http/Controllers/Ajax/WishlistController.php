<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FontendController;
use Illuminate\Http\Request;
use App\Repositories\WishlistRepository;
use App\Repositories\ProductRepository;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;

class WishlistController extends FontendController
{
    protected $productRepository;
    protected $wishlistRepository;
    protected $wishlistService;

    public function __construct(
        WishlistRepository $wishlistRepository,
        ProductRepository $productRepository,
        WishlistService $wishlistService,
    ) {
        $this->wishlistRepository = $wishlistRepository;
        $this->wishlistService = $wishlistService;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        $wishlists = $this->wishlistService->paginate($request);
        // dd($wishlists);
        return view('fontend.wishlist.index', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $userId = Auth::id();
            $productId = $request->input('product_id');
            $variantId = $request->input('product_variant_id');
    
            // Nhận thông báo từ service
            $result = $this->wishlistService->toggle($request, $userId, $productId, $variantId);
    
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra.',
            ], 500);
        }
    }
    public function destroyCart(Request $request)
    {
        // if (!Auth::check()) {
        //     flash()->error('Bạn cần đăng nhập để sử dụng chức năng.');
        //     return redirect()->route('auth.login');
        // }

        // try {
        //     $destroy = $this->wishlistService->destroy($request);

        //     if ($destroy) {
        //         return response()->json([
        //             'code' => 10,
        //             'message' => 'Sản phẩm đã được xóa.',
        //         ]);
        //     } else {
        //         return response()->json([
        //             'code' => 11,
        //             'message' => 'Có lỗi xảy ra!'
        //         ]);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'code' => 11,
        //         'message' => 'Có lỗi xảy ra!',
        //     ]);
        // }
    }
    public function clearCart(Request $request)
    {
        // if (!Auth::check()) {
        //     flash()->error('Bạn cần đăng nhập để sử dụng chức năng.');
        //     return redirect()->route('auth.login');
        // }

        // try {
        //     $clear = $this->wishlistService->clear($request);
        //     if ($clear) {
        //         return response()->json([
        //             'code' => 10,
        //             'message' => 'Giỏ hàng đã được xóa',
        //             'redirect' => route('cart.index')
        //         ]);
        //     } else {
        //         return response()->json([
        //             'code' => 11,
        //             'message' => 'Có lỗi xảy ra!'
        //         ]);
        //     }
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'code' => 11,
        //         'message' => 'Có lỗi xảy ra!'
        //     ]);
        // }
    }
}
