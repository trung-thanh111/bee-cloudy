<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FontendController;
use App\Models\PromotionProductVariant;
use Illuminate\Http\Request;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Promotion;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\DB;

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
        // Đặt lại total_discount nếu không có mã khuyến mãi
        if (!session()->has('promotions') || empty(session('promotions'))) {
            session()->put('total_discount', 0);
            session()->forget('shipping_fee');
            
        }

        $carts = $this->cartService->all();
        $userPromotion = Promotion::first();
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
            'userPromotion'
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

    
public function applyPromotion(Request $request) {
    $promotionCode = $request->input('promotion_code');
    $promotions = session()->get('promotions', []);

    if (in_array($promotionCode, array_column($promotions, 'code'))) {
        return redirect()->back()->with('error', 'Mã khuyến mãi này đã được áp dụng trước đó.');
    }

    if (count($promotions) >= 2) {
        return redirect()->back()->with('error', 'Không thể áp dụng quá 2 mã khuyến mãi.');
    }

    $userPromotion = Promotion::where('code', $promotionCode)->first();
    if (!$userPromotion) {
        return redirect()->back()->with('error', 'Mã khuyến mãi không tồn tại.');
    }

    $cart = Cart::where('user_id', Auth::id())->first();
    if (!$cart) {
        return redirect()->back()->with('error', 'Không tìm thấy giỏ hàng.');
    }

    // Lưu original_price nếu chưa có trước khi áp dụng giảm giá
    // foreach ($cart->cartItems as $item) {
    //     if (is_null($item->original_price)) {
    //         $item->original_price = $item->price;
    //         $item->save();
    //     }
    // }

    $totalDiscount = session()->get('total_discount', 0);
    $canApplyPromotion = false;

    // New condition: Prevent applying same type if already applied
    if (in_array($userPromotion->apply_for, array_column($promotions, 'apply_for'))) {
        return redirect()->back()->with('error', 'Không thể áp dụng nhiều mã giảm giá cùng loại.');
    }

    if ($userPromotion->apply_for === 'specific_products') {
        if (in_array('all', array_column($promotions, 'apply_for'))) {
            return redirect()->back()->with('error', 'Không thể áp dụng mã cho sản phẩm cụ thể khi đã có mã giảm giá toàn bộ.');
        }

        $promotionProducts = PromotionProductVariant::where('promotion_id', $userPromotion->id)
            ->pluck('product_id')
            ->toArray();

        foreach ($cart->cartItems as $item) {
            if (in_array($item->product_id, $promotionProducts)) {
                $discountAmount = min($item->price, $userPromotion->discount);
                $item->price -= $discountAmount;
                $totalDiscount += $discountAmount;
                $canApplyPromotion = true;
            }
        }

        if (!$canApplyPromotion) {
            return redirect()->back()->with('error', 'Không có sản phẩm nào trong giỏ hàng đủ điều kiện.');
        }
    } elseif ($userPromotion->apply_for === 'all') {
        if (in_array('specific_products', array_column($promotions, 'apply_for'))) {
            return redirect()->back()->with('error', 'Không thể áp dụng mã cho toàn bộ khi đã có mã sản phẩm cụ thể.');
        }

        session()->put('discount', $userPromotion->discount);
        $totalDiscount += $userPromotion->discount;
        $canApplyPromotion = true;
    } elseif ($userPromotion->apply_for === 'freeship') {
        if (in_array('freeship', array_column($promotions, 'apply_for'))) {
            return redirect()->back()->with('error', 'Đã có mã miễn phí vận chuyển.');
        }

        session()->put('shipping_fee', 0);
        $canApplyPromotion = true;
    }

    if ($canApplyPromotion) {
        $promotions[] = [
            'code' => $userPromotion->code,
            'apply_for' => $userPromotion->apply_for,
            'discount' => $userPromotion->discount
        ];
        session()->put('promotions', $promotions);
        session()->put('total_discount', $totalDiscount);

        return redirect()->back()->with('success', 'Mã giảm giá đã được áp dụng thành công.');
    }

    return redirect()->back()->with('error', 'Không thể áp dụng mã giảm giá.');
}

    public function removeVoucher($promotionCode) {
        $promotions = session()->get('promotions', []);
        $promotionIndex = array_search($promotionCode, array_column($promotions, 'code'));
    
        if ($promotionIndex !== false) {
            unset($promotions[$promotionIndex]);
            session()->put('promotions', array_values($promotions));
    
            $cart = Cart::where('user_id', Auth::id())->first();
            // foreach ($cart->cartItems as $item) {
            //     if (isset($item->original_price)) {
            //         $item->price = $item->original_price;
            //         $item->save();
            //     }
            // }
    
            $totalDiscount = 0;
            $shippingFee = 25000; // Đặt lại phí vận chuyển mặc định
    
            foreach ($promotions as $promotion) {
                $promotionInfo = Promotion::where('code', $promotion['code'])->first();
                if (!$promotionInfo) continue;
    
                if ($promotion['apply_for'] === 'specific_products') {
                    $promotionProducts = PromotionProductVariant::where('promotion_id', $promotionInfo->id)
                        ->pluck('product_id')
                        ->toArray();
    
                    foreach ($cart->cartItems as $item) {
                        if (in_array($item->product_id, $promotionProducts)) {
                            $discountAmount = min($item->price, $promotion['discount']);
                            $item->price -= $discountAmount;
                            $item->save();
                            $totalDiscount += $discountAmount;
                        }
                    }
                } elseif ($promotion['apply_for'] === 'all') {
                    $totalDiscount += $promotion['discount'];
                } elseif ($promotion['apply_for'] === 'freeship') {
                    $shippingFee = 0;
                }
            }
    
            session()->put('total_discount', $totalDiscount);
            session()->put('shipping_fee', $shippingFee);
    
            return redirect()->back()->with('success', 'Mã giảm giá đã được xóa thành công.');
        }
    
        return redirect()->back()->with('error', 'Không tìm thấy mã giảm giá.');
    }
    
    
}