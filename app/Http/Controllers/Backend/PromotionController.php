<?php

namespace App\Http\Controllers\Backend;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\PromotionService;
use Illuminate\Support\Facades\Log;

class PromotionController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['keyword', 'publish', 'perpage']);
        $promotions = $this->promotionService->getFilteredPromotions($filters);
        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.catalogue.index',
            'promotions' => $promotions
        ]);
    }

    public function create()
    {
        $products = $this->promotionService->getAllProducts();
        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.catalogue.create',
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        try {
            $promotion = $this->promotionService->createPromotion($request->all());
            return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được tạo thành công!');
        } catch (Exception $e) {
            Log::error('Promotion creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Xảy ra lỗi khi tạo khuyến mãi.');
        }
    }

    public function edit($id)
    {
        try {
            $promotion = $this->promotionService->getPromotionWithProducts($id);
            $products = $this->promotionService->getAllProducts();

            return view('backend.dashboard.layout', [
                'template' => 'backend.promotion.catalogue.edit',
                'promotion' => $promotion,
                'products' => $products
            ]);
        } catch (Exception $e) {
            Log::error('Error loading promotion edit form: ' . $e->getMessage());
            return redirect()->route('promotions.index')->with('error', 'Không thể tải thông tin khuyến mãi.');
        }
    }

    public function update(Request $request, $id)
    {
        $this->promotionService->updatePromotion($id, $request->all());
        return redirect()->route('promotions.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    }


    public function destroy($id)
    {
        try {
            $this->promotionService->deletePromotion($id);
            return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được xóa thành công.');
        } catch (Exception $e) {
            Log::error('Delete promotion error: ' . $e->getMessage());
            return redirect()->route('promotions.index')->with('error', 'Xảy ra lỗi khi xóa khuyến mãi.');
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('id');
        if ($ids) {
            try {
                $this->promotionService->bulkDeletePromotions(explode(',', $ids));
                return redirect()->route('promotions.index')->with('success', 'Xóa thành công các bản ghi.');
            } catch (Exception $e) {
                Log::error('Bulk delete error: ' . $e->getMessage());
                return redirect()->route('promotions.index')->with('error', 'Xảy ra lỗi khi xóa các bản ghi. Vui lòng thử lại.');
            }
        }
        return redirect()->route('promotions.index')->with('warning', 'Không có bản ghi nào được chọn để xóa.');
    }

    public function show($id)
    {
        $promotion = $this->promotionService->getPromotionWithProducts($id);
        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.catalogue.show',
            'promotion' => $promotion,
        ]);
    }

    public function showAllPromotions()
    {
        $promotions = $this->promotionService->getAllPromotionsWithDates();
        return view('fontend.promotion.index', compact('promotions'));
    }

    public function receivePromotion($id)
    {
        try {
            $message = $this->promotionService->receivePromotion($id);
            return redirect()->back()->with($message['type'], $message['text']);
        } catch (Exception $e) {
            Log::error('Receive promotion error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Xảy ra lỗi khi nhận voucher.');
        }
    }

    public function myPromotions()
    {
        $promotions = $this->promotionService->getUserPromotions();
        return view('fontend.promotion.my_vouchers', compact('promotions'));
    }
}