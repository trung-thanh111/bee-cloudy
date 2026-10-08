<?php

namespace App\Http\Controllers\Backend;

use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    // Hiển thị danh sách các vouchers
    public function index()
    {
        $vouchers = Voucher::all();
        $template = 'backend.voucher.index';
        return view('backend.dashboard.layout', compact('template', 'vouchers'));
    }

    // Trả về view để tạo voucher mới
    public function create()
    {
        $template = 'backend.voucher.create';
        return view('backend.dashboard.layout', compact('template'));
    }

    // Lưu voucher mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_value' => 'required|numeric',
            'minimum_amount' => 'nullable|numeric',
            'usage_limit' => 'nullable|integer',
            'apply_for' => 'required|in:specific_products,new_accounts,all',
        ]);

        // Tạo mã code ngẫu nhiên cho voucher (8 ký tự cả chữ và số)
        $randomCode = Str::upper(Str::random(8)); // Ví dụ mã code sẽ có 8 ký tự

        // Tạo voucher mới với mã code ngẫu nhiên
        Voucher::create([
            'name' => $request->input('name'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'discount_value' => $request->input('discount_value'),
            'minimum_amount' => $request->input('minimum_amount'),
            'usage_limit' => $request->input('usage_limit'),
            'apply_for' => $request->input('apply_for'),
            'code' => $randomCode, // Gán mã code ngẫu nhiên vào cột 'code'
        ]);

        // Chuyển hướng về danh sách vouchers sau khi tạo thành công
        return redirect()->route('voucher.index')->with('success', 'Voucher created successfully.');
    }
    public function showAllVouchers()
    {
        // Lấy tất cả các voucher có 'usage_limit' lớn hơn 0
        $vouchers = Voucher::where('usage_limit', '>', 0)->get();

        // Truyền danh sách voucher vào view
        return view('fontend.voucher.list', compact('vouchers'));
    }
    public function receiveVoucher($voucherId)
{
    // Lấy người dùng hiện tại
    $user = Auth::user();

    // Lấy voucher từ ID
    $voucher = Voucher::find($voucherId);

    // Kiểm tra nếu voucher không còn khả dụng
    if ($voucher->usage_limit <= 0) {
        return redirect()->back()->with('error', 'Voucher này đã hết.');
    }

    // Kiểm tra xem người dùng đã nhận voucher này chưa
    if ($user->vouchers->contains($voucher->id)) {
        return redirect()->back()->with('error', 'Bạn đã nhận voucher này rồi.');
    }

    // Gán voucher cho người dùng
    $user->vouchers()->attach($voucher->id);

    // Giảm số lượng 'usage_limit' đi 1
    $voucher->decrement('usage_limit');

    return redirect()->back()->with('success', 'Bạn đã nhận voucher thành công!');
}
// public function destroy($id)
// {
//     // Tìm voucher theo ID
//     $voucher = Voucher::findOrFail($id);

//     // Xóa voucher
//     $voucher->delete();

//     // Chuyển hướng về trang danh sách voucher với thông báo thành công
//     return redirect()->route('voucher.index')->with([
//         'success' => 'Voucher đã được xóa thành công.',
//         'voucher' => $voucher
//     ]);
// }


// public function edit($id)
// {
//     // Tìm voucher theo ID
//     $voucher = Voucher::findOrFail($id);

//     // Truyền voucher vào view chỉnh sửa
//     return view('vouchers.edit', compact('voucher'));
// }

// public function update(Request $request, $id)
// {
//     // Validate dữ liệu
//     $request->validate([
//         'name' => 'required|string|max:255',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date|after_or_equal:start_date',
//         'discount_value' => 'required|numeric',
//         'usage_limit' => 'nullable|integer',
//         'status' => 'required|in:active,inactive',
//     ]);

//     // Tìm voucher theo ID
//     $voucher = Voucher::findOrFail($id);

//     // Cập nhật dữ liệu voucher
//     $voucher->update($request->all());

//     // Chuyển hướng về trang danh sách voucher với thông báo thành công
//     return redirect()->route('vouchers.index')->with('success', 'Voucher đã được cập nhật thành công.');
// }





}
