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
use Illuminate\Support\Facades\Log;
use Exception;
use Carbon\Carbon;

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
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            // 'discount' chỉ bắt buộc nếu apply_for không phải là 'freeship'
            'discount' => $request->apply_for === 'freeship' ? 'nullable' : 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',  // Số tiền tối thiểu để áp dụng khuyến mãi
            'usage_limit' => 'nullable|integer|min:1',  // Giới hạn số lần sử dụng
            'apply_for' => 'required|in:specific_products,freeship,all',
            'status' => 'required|in:active,inactive',
            'product_id' => 'nullable|exists:products,id',  // Chỉ yêu cầu nếu chọn sản phẩm cụ thể
        ]);

        // Tạo mã khuyến mãi ngẫu nhiên
        $code = strtoupper(Str::random(6));

        // Xử lý chiết khấu cho freeship và all
        if ($validated['apply_for'] === 'freeship') {
            $discount = 0;  // Nếu là freeship, chiết khấu = 0
        } else {
            $discount = $validated['discount'];  // Dùng chiết khấu cho tất cả hoặc sản phẩm cụ thể
        }

        // Tạo mới khuyến mãi trong bảng 'promotions'
        $promotion = Promotion::create([
            'name' => $validated['name'],
            'code' => $code,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'discount' => $discount,
            'minimum_amount' => $validated['minimum_amount'],  // Số tiền tối thiểu
            'usage_limit' => $validated['usage_limit'],  // Giới hạn sử dụng
            'apply_for' => $validated['apply_for'],
            'status' => $validated['status'],
        ]);

        // Nếu apply_for là 'specific_products', lưu chiết khấu vào bảng promotion_product_variants
        if ($validated['apply_for'] === 'specific_products') {
            PromotionProductVariant::create([
                'promotion_id' => $promotion->id,
                'product_id' => $validated['product_id'],  // Chỉ một sản phẩm duy nhất
                'discount' => $discount,  // Chiết khấu cho sản phẩm được chọn
            ]);
        }

        return redirect()->route('promotions.index')->with('success', 'Khuyến mãi đã được tạo thành công!');
    }



    public function showAllPromotions()
    {
        // Fetch all promotions and convert date fields to Carbon instances
        $promotions = Promotion::all()->map(function ($promotion) {
            $promotion->start_date = Carbon::parse($promotion->start_date);
            $promotion->end_date = Carbon::parse($promotion->end_date);
            return $promotion;
        });

        return view('fontend.promotion.index', compact(
            'promotions'
        ));
    }

    public function receivePromotion(Promotion $promotion, Request $request)
    {
        $user = Auth::user();

        // Kiểm tra usage_limit của voucher
        if ($promotion->usage_limit <= 0) {
            return redirect()->back()->with('error', 'Voucher đã hết.');
        }

        // Kiểm tra xem người dùng đã nhận voucher này chưa
        $existingVoucher = UserVoucher::where('user_id', $user->id)
            ->where('promotion_id', $promotion->id)
            ->first();
        if ($existingVoucher) {
            return redirect()->back()->with('error', 'Bạn đã nhận voucher này rồi.');
        }

        // Lấy mã code từ bảng promotion dựa trên promotion_id
        $voucherCode = $promotion->code;  // Mã code được lấy từ bảng promotions

        // Giảm usage_limit khi voucher được nhận
        $promotion->usage_limit -= 1;
        $promotion->save();

        // Tạo voucher cho người dùng với mã từ promotion
        UserVoucher::create([
            'user_id' => $user->id,
            'promotion_id' => $promotion->id,
            'code' => $voucherCode, // Gán mã code từ bảng promotion vào user_voucher
            'received_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Voucher nhận thành công');
    }
    public function confirmDelete($id)
    {
        // Tìm khuyến mãi theo ID
        $promotion = Promotion::findOrFail($id);
        $template = 'backend.promotion.catalogue.delete';
        // Trả về trang delete.blade.php để xác nhận
        return view('backend.dashboard.layout', compact('template', 'promotion'));
    }

    public function destroy($id)
    {
        // Tìm khuyến mãi theo ID
        $promotion = Promotion::findOrFail($id);
        $result = $promotion->delete();
        
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
            'discount' => 'required|numeric|min:0',
            'minimum_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'apply_for' => 'required|in:specific_products,freeship,all',

            'status' => 'required|in:active,inactive',
        ]);

        // Cập nhật thông tin khuyến mãi
        $promotion->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'discount' => $request->input('discount'),
            'minimum_amount' => $request->input('minimum_amount'),
            'usage_limit' => $request->input('usage_limit'),
            'apply_for' => $request->input('apply_for'),
            'status' => $request->input('status'),
        ]);

        $promotions = Promotion::all();
        // Trả về view để hiển thị form chỉnh sửa, truyền dữ liệu khuyến mãi hiện tại
        $template = 'backend.promotion.catalogue.index';
        return view('backend.dashboard.layout', compact('template', 'promotions'))->with('success', 'Cập nhật khuyến mãi thành công!');
    }
    public function show($id)
    {
        $promotion = Promotion::with('products')->findOrFail($id);

        return view('backend.dashboard.layout', [
            'template' => 'backend.promotion.catalogue.show',
            'promotion' => $promotion
        ]);
    }
    public function bulkDelete(Request $request)
    {
        // Retrieve the list of IDs from the input
        $listId = $request->input('id');

        // Check if listId is provided and not empty
        if ($listId) {
            try {
                // Convert the list of IDs from a string to an array
                $arrayId = explode(',', $listId);

                // Perform the bulk delete operation
                Promotion::whereIn('id', $arrayId)->delete();

                // Flash success message
                return redirect()->route('promotions.index')->with('success', 'Xóa thành công các bản ghi.');
            } catch (Exception $e) {
                // Log any exception that occurs
                Log::error('Bulk delete error: ' . $e->getMessage());

                // Flash error message
                return redirect()->route('promotions.index')->with('error', 'Xảy ra lỗi khi xóa các bản ghi. Vui lòng thử lại.');
            }
        } else {
            // Flash warning message if no IDs were provided
            return redirect()->route('promotions.index')->with('warning', 'Không có bản ghi nào được chọn để xóa.');
        }
    }



}
