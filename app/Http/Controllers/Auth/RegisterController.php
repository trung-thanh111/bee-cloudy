<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Str;
use App\Models\PendingUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        // nếu đã đăng nhập rồi thì redirect về trang ch
        // if(Auth::check()){
        //     return redirect()->route('home.index');
        // }
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        // Kiểm tra nếu email đã tồn tại trong pending_users
        $existingPendingUser = PendingUser::where('email', $request->email)->first();

        if ($existingPendingUser) {
            // Nếu tồn tại, xóa bản ghi cũ
            $existingPendingUser->delete();
        }

        // Tạo token mới cho việc xác nhận email
        $token = Str::random(60);

        // Lưu thông tin người dùng vào bảng pending_users
        $pendingUser = PendingUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'token' => $token,
        ]);

        // Gửi email xác nhận
        Mail::to($pendingUser->email)->send(new ConfirmEmail($pendingUser));

        return redirect()->route('auth.login')->with('status', 'Vui lòng kiểm tra email để xác nhận đăng ký.');
    }



    public function confirmRegistration($token)
    {
        // Tìm pending user dựa trên token
        $pendingUser = PendingUser::where('token', $token)->firstOrFail();

        // Tạo tài khoản chính thức cho người dùng
        $user = User::create([
            'name' => $pendingUser->name,
            'email' => $pendingUser->email,
            'password' => $pendingUser->password, // Đã được hash từ trước
        ]);

        // Xóa pending user sau khi xác nhận thành công
        $pendingUser->delete();

        // Đăng nhập người dùng sau khi xác nhận
        Auth::login($user);

        return redirect()->route('home.index')->with('status', 'Xác nhận thành công! Bạn đã được đăng nhập.');
    }
}
