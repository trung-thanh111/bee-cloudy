<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FontendController;

use Illuminate\Http\Request;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;

class CartController extends FontendController
{
    protected $productRepository;
    protected $cartRepository;
    protected $cartService;

    public function __construct(
        CartRepository $cartRepository,
        ProductRepository $productRepository,
        CartService $cartService,
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
    }

    public function index()
{
    $carts = $this->cartService->all();
    $attributesByCartItem = $this->cartService->findAttributesByCode();
    $productNews = $this->productRepository->getLimit(
        ['productVariant', 'productCatalogues', 'productVariant.attributes'],
        [
            ['publish', '=', 1],
            ['created_at', 'DESC']
        ],
        4
    );

    $countCart = $this->cartService->countProductIncart();

    return view('fontend.cart.index', compact(
        'carts',
        'countCart',
        'productNews',
        'attributesByCartItem'
    ));
}
    

    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $carts = $this->cartService->create($request);
            return response()->json([
                'code' => 10,
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng.',
                'carts' => $carts,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.',
            ], 500);
        }
    }
    public function updateCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $updated = $this->cartService->update($request);
            if ($updated) {
                return response()->json([
                    'code' => 10,
                    'message' => 'Cập nhật thành công.',
                ]);
            } else {
                return response()->json([
                    'code' => 11,
                    'message' => 'Không thể cập nhật giỏ hàng.',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi cập nhật giỏ hàng.',
            ], 500);
        }
    }
    public function destroyCart(Request $request)
    {
        if (!Auth::check()) {
            flash()->error('Bạn cần đăng nhập để sử dụng chức năng.');
            return redirect()->route('auth.login');
        }

        try {
            $destroy = $this->cartService->destroy($request);

            if ($destroy) {
                return response()->json([
                    'code' => 10,
                    'message' => 'Sản phẩm đã được xóa.',
                ]);
            } else {
                return response()->json([
                    'code' => 11,
                    'message' => 'Có lỗi xảy ra!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra!',
            ]);
        }
    }
    public function clearCart(Request $request)
    {
        if (!Auth::check()) {
            flash()->error('Bạn cần đăng nhập để sử dụng chức năng.');
            return redirect()->route('auth.login');
        }

        try {
            $clear = $this->cartService->clear($request);
            if ($clear) {
                return response()->json([
                    'code' => 10,
                    'message' => 'Giỏ hàng đã được xóa',
                    'redirect' => route('cart.index')
                ]);
            } else {
                return response()->json([
                    'code' => 11,
                    'message' => 'Có lỗi xảy ra!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra!'
            ]);
        }
    }
}
