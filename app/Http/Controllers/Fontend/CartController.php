<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\FontendController;
use App\Models\Order;
use App\Repositories\CartRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
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
    public function destroyCart(Request $request)
    {
        if (!Auth::check()) {
            flash()->erorr('Bạn cần đăng nhập để sử dụng chức năng.');
            return redirect()->route('auth.login');
        }
            $destroy = $this->cartService->destroy($request);
            if ($destroy) {
                flash()->success('sản phẩm đã xóa khỏi giỏ hàng!');
                return redirect()->back();
            } else {
                flash()->error('Có lỗi xảy ra!');
                return redirect()->back();
            }
    }
}
