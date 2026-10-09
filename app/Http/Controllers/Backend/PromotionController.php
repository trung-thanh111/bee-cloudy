<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use App\Services\PromotionService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        $promotions = $this->promotionService->getAllPromotions();
        $template = 'backend.promotion.catalogue.index';
        return view('backend.dashboard.layout', compact('template', 'promotions'));
    }

    public function create()
    {
        $products = Product::all();
        $template = 'backend.promotion.catalogue.create';
        return view('backend.dashboard.layout', compact('template', 'products'));
    }

    public function store(Request $request)
    {
        $this->promotionService->createPromotion($request);
        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được tạo thành công!');
    }

    public function receivePromotion(Promotion $promotion)
    {
        $message = $this->promotionService->receivePromotion($promotion);
        return redirect()->back()->with('message', $message);
    }

    public function confirmDelete($id)
    {
        $promotion = $this->promotionService->getPromotionWithProducts($id);
        $template = 'backend.promotion.catalogue.delete';
        return view('backend.dashboard.layout', compact('template', 'promotion'));
    }

    public function destroy($id)
    {
        $this->promotionService->deletePromotion($id);
        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được xóa.');
    }

    public function myPromotions()
    {
        $userId = Auth::id();
        $promotions = $this->promotionService->getUserPromotions($userId);
        return view('fontend.promotion.my_vouchers', compact('promotions'));
    }

    public function edit($id)
    {
        $promotion = $this->promotionService->getPromotionWithProducts($id);
        $template = 'backend.promotion.catalogue.edit';
        return view('backend.dashboard.layout', compact('template', 'promotion'));
    }

    public function update(Request $request, $id)
    {
        $promotion = Promotion::findOrFail($id);
        $this->promotionService->updatePromotion($promotion, $request);
        return redirect()->route('promotions.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    }

    public function show($id)
    {
        $promotion = $this->promotionService->getPromotionWithProducts($id);
        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.catalogue.show',
            'promotion' => $promotion,
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $listId = $request->input('id');
        if ($listId) {
            try {
                $arrayId = explode(',', $listId);
                $this->promotionService->bulkDeletePromotions($arrayId);
                return redirect()->route('promotions.index')->with('success', 'Xóa thành công các bản ghi.');
            } catch (Exception $e) {
                return redirect()->route('promotions.index')->with('error', 'Xảy ra lỗi khi xóa các bản ghi. Vui lòng thử lại.');
            }
        } else {
            return redirect()->route('promotions.index')->with('warning', 'Không có bản ghi nào được chọn để xóa.');
        }
    }
}
