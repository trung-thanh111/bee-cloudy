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
        $promotions = $this->promotionService->paginate($request);
        // dd($promotions);
        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.index',
            'promotions' => $promotions
        ]);
    }

    public function create()
    {
        $products = $this->promotionService->getAllProducts();
        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.create',
            'products' => $products
        ]);
    }


    public function store(Request $request)
{
    try {
        // Xác thực dữ liệu, bao gồm URL ảnh
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount' => 'required|nullable|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'required|integer|min:1',
            'apply_for' => 'required|in:specific_products,freeship,all',
            'status' => 'required|in:active,inactive',
            'product_id' => 'nullable|exists:products,id|required_if:apply_for,specific_products',
        ]);

        // Gọi PromotionService để tạo khuyến mãi
        $promotion = $this->promotionService->createPromotion($validatedData);
        // $errors = ['name' => 'Đây là lỗi thử nghiệm.'];
        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được tạo thành công!');
    } catch (\Exception $e) {
        $errors = [
            'name' => 'Bạn chưa nhập tên giảm giá',
            'image' => 'Bạn chưa chọn ảnh cho giảm giá',
            'start_date' => 'Bạn chưa chọn ngày bắt đầu',
            'discount' => 'Bạn chưa nhập giá trị giảm ',
            'end_date' => 'Bạn chưa chọn ngày kết thúc',
            'usage_limit' => 'Bạn chưa nhập số lượng giảm giá',
            'apply_for' => 'Bạn chưa chọn áp dụng',
            'product_id' => 'Bạn chưa chọn sản phẩm',
        ];
        
        return redirect()->back()->withErrors($errors)->with('error', 'Xảy ra lỗi khi tạo khuyến mãi: ');
    }
    
}


    public function edit($id)
    {
        try {
            $promotion = $this->promotionService->getPromotionWithProducts($id);
            $products = $this->promotionService->getAllProducts();

            return view('backend.dashboard.layout', [
                'template' => 'backend.promotion.edit',
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
        // dd($request->all());
        $this->promotionService->updatePromotion($id, $request->all());
        return redirect()->route('promotions.index')->with('success', 'Cập nhật khuyến mãi thành công!');
    }


    public function destroy($id)
    {
        try {
            $this->promotionService->deletePromotion($id);
            return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được xóa thành công.');
        } catch (Exception $e) {
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
            'template' => 'backend.promotion.show',
            'promotion' => $promotion,
        ]);
    }

}