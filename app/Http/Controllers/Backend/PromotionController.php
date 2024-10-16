<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\UserVoucher;
use App\Models\PromotionProductVariant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PromotionController extends Controller
{
    public function index()
    {
        
        $promotions = Promotion::all();
        $template = 'backend.promotion.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'promotions'
        ));
    }

    // Phương thức hiển thị form tạo promotion
    public function create()
    {
        $products = Product::all();
        $template = 'backend.promotion.catalogue.create';
        return view('backend.dashboard.layout', compact('template', 'products'));
    }
    public function store(Request $request)
    {
        // Điều chỉnh quy tắc xác thực
        $validationRules = [
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_value' => 'required|numeric',
            'minimum_amount' => 'nullable|numeric',
            'usage_limit' => 'nullable|integer',
            'apply_for' => 'required|in:specific_products,new_accounts,all',
        ];

        // Thêm quy tắc xác thực cho sản phẩm cụ thể chỉ khi apply_for là 'specific_products'
        if ($request->input('apply_for') === 'specific_products') {
            $validationRules['products'] = 'required|array|min:1';
            $validationRules['discounts'] = 'required|array|min:1';
            $validationRules['discounts.*'] = 'required|numeric|min:0|max:100';
        }

        // Xác thực dữ liệu
        $validated = $request->validate($validationRules);

        // Tạo mã code ngẫu nhiên cho promotion
        $randomCode = Str::upper(Str::random(8));

        // Tạo promotion mới
        $promotion = Promotion::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'discount_value' => $request->input('discount_value'),
            'minimum_amount' => $request->input('minimum_amount'),
            'usage_limit' => $request->input('usage_limit'),
            'apply_for' => $request->input('apply_for'),
            'code' => $randomCode,
        ]);

        // Xử lý sản phẩm cụ thể nếu apply_for là 'specific_products'
        if ($request->input('apply_for') === 'specific_products') {
            $products = $request->input('products', []);
            $discounts = $request->input('discounts', []);

            foreach ($products as $index => $productId) {
                if (isset($discounts[$index])) {
                    PromotionProductVariant::create([
                        'promotion_id' => $promotion->id,
                        'product_id' => $productId,
                        'discount' => $discounts[$index]
                    ]);
                }
            }
        }

        // Điều hướng sau khi lưu thành công
        return redirect()->route('promotions.catalogue.store')->with('success', 'Promotion created successfully.');
    }
    public function showAllPromotions()
    {
        $user = Auth::user();
        $promotions = Promotion::where('usage_limit', '>', 0)->get();
        return view('fontend.promotion.index', compact('promotions','user'));
    }
    public function delete(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        Promotion::whereIn('id', $ids)->delete();
        return redirect()->route('promotions.index')->with('success', 'Đã xóa thành công các mục đã chọn.');
    }

    public function receivePromotion(Request $request, $promotionId)
    {
        $userId = Auth::id();
    
        DB::beginTransaction();
    
        try {
            $promotion = Promotion::lockForUpdate()->findOrFail($promotionId);
    
            if ($promotion->usage_limit < 1) {
                throw new \Exception('Promotion này đã hết.');
            }
    
            if ($promotion->apply_for !== 'specific_products') {
                throw new \Exception('Promotion này không áp dụng cho sản phẩm cụ thể.');
            }
    
            $existingPromotion = UserVoucher::where('user_id', $userId)
                ->where('promotion_id', $promotionId)
                ->first();
    
            if ($existingPromotion) {
                throw new \Exception('Bạn đã nhận promotion này rồi.');
            }
    
            // Decrement the usage_limit first
            $promotion->usage_limit -= 1;
            $promotion->save();
    
            // Then create the UserVoucher
            UserVoucher::create([
                'user_id' => $userId,
                'promotion_id' => $promotionId,
            ]);
    
            DB::commit();
    
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Bạn đã nhận promotion thành công!']);
            }
    
            return redirect()->back()->with('success', 'Bạn đã nhận promotion thành công!');
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error in receivePromotion: ' . $e->getMessage());
    
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
    
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function myPromotions()
    {
        $userId = Auth::id();

        // Lấy danh sách các promotion mà người dùng đã nhận
        $promotions = UserVoucher::where('user_id', $userId)->get();

        // Trả về view hiển thị danh sách promotion
        return view('fontend.promotion.my_vouchers', compact('promotions'));
    }
    public function edit($id)
    {
        // Tìm khuyến mãi theo ID
        $promotion = Promotion::findOrFail($id);  // Tìm khuyến mãi theo ID
        $template = 'backend.promotion.catalogue.edit';
        // Trả về view để hiển thị form chỉnh sửa, truyền dữ liệu khuyến mãi hiện tại
        return view('backend.dashboard.layout', compact('template', 'promotion'));
    }


    public function update(Request $request, $id)
    {
        // Tìm khuyến mãi theo ID
        $promotion = Promotion::findOrFail($id);

        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:promotions,code,' . $id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'discount_value' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_for' => 'required|in:specific_products,new_accounts,all',
            'status' => 'required|in:active,inactive',
        ]);

        // Cập nhật thông tin khuyến mãi
        $promotion->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'discount_value' => $request->input('discount_value'),
            'minimum_amount' => $request->input('minimum_amount'),
            'usage_limit' => $request->input('usage_limit'),
            'apply_for' => $request->input('apply_for'),
            'status' => $request->input('status'),
        ]);

        $promotions = Promotion::all();
        $template = 'backend.promotion.catalogue.index';

        // Trả về view để hiển thị form chỉnh sửa, truyền dữ liệu khuyến mãi hiện tại
        return view('backend.dashboard.layout', compact('template', 'promotions'))->with('success', 'Cập nhật khuyến mãi thành công!');
    }



}
