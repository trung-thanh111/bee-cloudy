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
    
        // Kiểm tra promotion đã tồn tại
        if (in_array($promotionCode, array_column($promotions, 'code'))) {
            return redirect()->back()->with('error', 'Mã khuyến mãi này đã được áp dụng trước đó.');
        }
    
        // Kiểm tra số lượng promotion
        if (count($promotions) >= 2) {
            return redirect()->back()->with('error', 'Không thể áp dụng quá 2 mã khuyến mãi.');
        }
    
        $userPromotion = Promotion::where('code', $promotionCode)->first();
        if (!$userPromotion) {
            return redirect()->back()->with('error', 'Mã khuyến mãi không tồn tại.');
        }
    
        // Kiểm tra các loại promotion đã áp dụng
        $hasFreeShip = in_array('freeship', array_column($promotions, 'apply_for'));
        $hasAll = in_array('all', array_column($promotions, 'apply_for'));
        $hasSpecific = in_array('specific_products', array_column($promotions, 'apply_for'));
    
        // Lấy cart
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart) {
            return redirect()->back()->with('error', 'Không tìm thấy giỏ hàng.');
        }
    
        $totalDiscount = 0;
        $canApplyPromotion = false;
    
        // Xử lý specific products
        if ($userPromotion->apply_for === 'specific_products') {
            if ($hasSpecific || $hasAll) {
                return redirect()->back()->with('error', 'Không thể áp dụng mã cho sản phẩm cụ thể khi đã có mã giảm giá khác.');
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
        }
        // Xử lý all products
        elseif ($userPromotion->apply_for === 'all') {
            if ($hasSpecific || $hasAll) {
                return redirect()->back()->with('error', 'Không thể áp dụng mã cho tất cả sản phẩm khi đã có mã giảm giá khác.');
            }
            
            // Lưu discount vào session thay vì trừ trực tiếp vào giá sản phẩm
            session()->put('discount', $userPromotion->discount);
            $canApplyPromotion = true;
        }
        // Xử lý freeship
        elseif ($userPromotion->apply_for === 'freeship') {
            if ($hasFreeShip) {
                return redirect()->back()->with('error', 'Đã có mã miễn phí vận chuyển.');
            }
            $canApplyPromotion = true;
        }
    
        // Nếu có thể áp dụng promotion
        if ($canApplyPromotion) {
            // Lưu thông tin promotion vào session
            $promotions[] = [
                'code' => $promotionCode,
                'apply_for' => $userPromotion->apply_for,
                'discount' => $userPromotion->discount
            ];
            session()->put('promotions', $promotions);
    
            // Lưu thay đổi vào database (chỉ khi không phải type 'all')
            if ($userPromotion->apply_for !== 'all') {
                foreach ($cart->cartItems as $item) {
                    $item->save();
                }
                $cart->total_price -= $totalDiscount;
                $cart->save();
            }
    
            return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công.');
        }
    
        return redirect()->back()->with('error', 'Không thể áp dụng mã giảm giá.');
    }

    public function removeVoucher($voucherId)
    {
        try {
            $promotions = session()->get('promotions', []);
            $promotionIndex = array_search($voucherId, array_column($promotions, 'code'));
            
            if ($promotionIndex !== false) {
                // Lưu thông tin promotion sẽ xóa để check type
                $removedPromotion = $promotions[$promotionIndex];
                unset($promotions[$promotionIndex]);
                session()->put('promotions', array_values($promotions));
                
                // Xóa discount trong session nếu promotion type là 'all'
                if ($removedPromotion['apply_for'] === 'all') {
                    session()->forget('discount');
                }

                $cart = Cart::where('user_id', Auth::id())->first();
                if ($cart) {
                    // Reset prices và recalculate (chỉ khi không phải type 'all')
                    if ($removedPromotion['apply_for'] !== 'all') {
                        foreach ($cart->cartItems as $item) {
                            // Reset item price về original
                            $item->price = $item->original_price;
                            $item->save();
                        }
                    }
    
                    // Xử lý freeship
                    if ($removedPromotion['apply_for'] === 'freeship') {
                        $cart->shipping_fee = 0; // Reset shipping fee về 0 hoặc giá trị mặc định
                    }
    
                    // Reapply các promotions còn lại
                    foreach ($promotions as $promotion) {
                        if ($promotion['apply_for'] === 'specific_products') {
                            // Lấy danh sách sản phẩm được áp dụng
                            $promotionInfo = Promotion::where('code', $promotion['code'])->first();
                            if ($promotionInfo) {
                                $promotionProducts = PromotionProductVariant::where('promotion_id', $promotionInfo->id)
                                    ->pluck('product_id')
                                    ->toArray();
    
                                foreach ($cart->cartItems as $item) {
                                    if (in_array($item->product_id, $promotionProducts)) {
                                        $discountAmount = min($item->price, $promotion['discount']);
                                        $item->price -= $discountAmount;
                                        $item->save();
                                    }
                                }
                            }
                        } elseif ($promotion['apply_for'] === 'all') {
                            // Không thực hiện gì cả vì discount đã được xử lý ở view
                            continue;
                        } elseif ($promotion['apply_for'] === 'freeship') {
                            $cart->shipping_fee = 0; // Set shipping fee = 0 for freeship
                        }
                    }
                    
                    // Tính toán lại tổng giá trị giỏ hàng
                    $cart->calculateTotals();
                    $cart->save();
                }
                
                return redirect()->back()->with('success', 'Voucher đã được xóa thành công.');
            }
            
            return redirect()->back()->with('error', 'Không tìm thấy voucher.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa voucher.');
        }
    }
}