<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Services\WishlistService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProductRepository;
use App\Repositories\WishlistRepository;
use App\Http\Controllers\FontendController;

class WishlistController extends FontendController
{
    protected $wishlistService;
    protected $productRepository;
    protected $wishlistRepository;

    public function __construct(
        WishlistService $wishlistService,
        ProductRepository $productRepository,
        WishlistRepository $wishlistRepository,
    ) {
        $this->wishlistService = $wishlistService;
        $this->productRepository = $productRepository;
        $this->wishlistRepository = $wishlistRepository;
    }

    public function index(Request $request)
    {
        $wishlists = $this->wishlistService->paginate($request);
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
    
}
