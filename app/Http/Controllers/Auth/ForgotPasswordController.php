<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        return view('auth.forgotPassword.vertifycation-email');
    }

    // Gửi email chứa mã OTP
    public function sendEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $otp = rand(100000, 999999);

            $request->session()->put('otp', $otp);
            $request->session()->put('email', $request->email);

            Mail::to($user->email)->send(new OtpMail($otp));

            return redirect()->route('password.otp')->with('status', 'Mã OTP đã được gửi tới email của bạn.');
        }

        return back()->withErrors(['email' => 'Không tìm thấy email này.']);
    }


    // Hiển thị form nhập OTP
    public function otpForm()
    {
        return view('auth.forgotPassword.otp');
    }

    // Xác thực mã OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $email = $request->session()->get('email');

        if ($request->otp == $request->session()->get('otp')) {
            $request->session()->forget('otp');

            return redirect()->route('password.reset', ['email' => $email]);
        }

        return back()->withErrors(['otp' => 'Mã OTP không chính xác.']);
    }

    // gửi lại email otp
    public function resendOtp(Request $request)
    {
        $email = $request->session()->get('email');

        if ($email) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $request->session()->forget('otp');
                $otp = rand(100000, 999999);
                $request->session()->put('otp', $otp);

                Mail::to($user->email)->send(new OtpMail($otp));

                return redirect()->route('password.otp')->with('status', 'Mã OTP mới đã được gửi tới email của bạn.');
            }
        }

        return redirect()->route('password.request')->withErrors(['email' => 'Email không hợp lệ. Vui lòng thử lại.']);
    }

    // Hiển thị form đổi mật khẩu
    public function resetForm(Request $request)
    {
        $email = $request->email ?? $request->session()->get('email');
        return view('auth.forgotPassword.reset-password', compact('email'));
    }

    // Đổi mật khẩu
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            $request->session()->forget('email');

            return redirect()->route('auth.login')->with('status', 'Mật khẩu đã được thay đổi thành công.');
        }

        return back()->withErrors(['email' => 'Không tìm thấy email này.']);
    }
}
