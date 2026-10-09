<?php

namespace App\Http\Controllers\Fontend;

use Exception;
use Carbon\Carbon;
use App\Services\PromotionService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FPromotionController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        $promotions = $this->promotionService->getAllPromotionsWithDates()->map(function ($promotion) {
            $promotion->start_date = Carbon::parse($promotion->start_date);
            $promotion->end_date = Carbon::parse($promotion->end_date);
            return $promotion;
        });

        return view('fontend.promotion.index', compact('promotions'));
    }

    public function receivePromotion(Promotion $promotion, Request $request)
    {
        try {
            $message = $this->promotionService->receivePromotion($promotion);
            if ($message === 'Voucher nhận thành công') {
                return redirect()->back()->with('success', $message);
            } else {
                return redirect()->back()->with('error', $message);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Xảy ra lỗi khi nhận voucher.');
        }
    }



    public function myPromotions()
    {
        $userId = Auth::id();

        $promotions = $this->promotionService->getUserPromotions($userId);
        return view('fontend.promotion.my_vouchers', compact('promotions'));
    }
    public function view_promotion(Request $request)
    { {
            $userVouchers = UserVoucher::with('promotion')
                ->where('user_id', Auth::id())
                ->paginate(8);
            // dd($userVouchers);
            foreach ($userVouchers as $voucher) {
                if ($voucher->promotion) {
                    $voucher->promotion->start_date = Carbon::parse($voucher->promotion->start_date);
                }
                if ($voucher->promotion) {
                    $voucher->promotion->end_date = Carbon::parse($voucher->promotion->end_date);
                }
            }
            return view('fontend.account.promotion', compact('userVouchers'));
        }
    }
    public function show($id)
    {
        // Fetch the UserVoucher along with its related promotion
        $userVoucher = UserVoucher::with('promotion')
            ->where('id', $id)
            ->firstOrFail();

        return view('fontend.account.promotion-detail', compact('userVoucher'));
    }
}
