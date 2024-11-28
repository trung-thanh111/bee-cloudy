<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChangePassRequest;
use App\Http\Requests\StoreResetPassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\OtpMail;

class ForgotPasswordController extends Controller
{
    // Hiển thị form nhập email
    public function emailForm()
    {
        return view('auth.forgot-password');
    }

    // Gửi email chứa mã OTP
    public function sendEmail(StoreChangePassRequest $request)
    {
        $email = $request->only('email');
        // dd($email);
        $user = User::where('email', $email)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $sessionOtp = $request->session()->put('otp', $otp);
            $sessionOtp = $request->session()->put('email', $email);

            Mail::to($user->email)->send(new OtpMail($otp));

            flash()->success('OTP đã được gửi về gmail'); // ở đây mới có error ssuccess war đủ loại
            return redirect()->route('password.otp');
        }
        flash()->error('Email của bạn chưa đăng ký');
        return back();
    }


    // Hiển thị form nhập OTP
    public function otpForm()
    {
        return view('auth.otp');
    }

    // Xác thực mã OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        // Lấy email đã lưu trong session
        $email = $request->session()->get('email');
        $stringEmail = implode(',',  $email);
        // dd($stringEmail);

        if ($request->otp == $request->session()->get('otp')) {
            $request->session()->forget(['otp']);

            flash()->success('Đổi Mật khẩu mới');
            return redirect()->route('password.reset');
        }

        flash()->error('Mã OTP không đúng');
        return back();
    }

    public function resendOtp(Request $request)
    {
        // Lấy email từ session
        $email = $request->session()->get('email');

        // Kiểm tra nếu có email trong session
        if ($email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $otp = rand(100000, 999999);
                $request->session()->put('otp', $otp);

                Mail::to($user->email)->send(new OtpMail($otp));

                flash()->success('Mã OTP mới đã được gửi lại');
                return redirect()->route('password.otp');
            }
        }

        flash()->error('Gửi lại OTP lỗi');
        return redirect()->route('password.reset');
    }


    public function resetForm(Request $request)
    {
        $email = $request->email ?? $request->session()->get('email');
        return view('auth.reset-password', compact('email'));
    }

    public function reset(StoreResetPassRequest $request)
    {
        $email = $request->session()->get('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);

            $user->save();

            $request->session()->forget('email');

            flash()->success('Mật khẩu được đổi');
            return redirect()->route('auth.login');
        }

        flash()->error('Lỗi đổi mật khẩu mới');
        return back();
    }
}
