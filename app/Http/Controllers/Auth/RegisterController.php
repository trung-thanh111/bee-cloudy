<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);
            $user->update(['email_verification_token' => $token]);

            Mail::to($user->email)->send(new ConfirmEmail($user));
        } else {
            $token = Str::random(60);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verification_token' => $token,
            ]);

            Mail::to($user->email)->send(new ConfirmEmail($user));
        }

        return redirect()->route('auth.login')->with('status', 'Vui lòng kiểm tra email để xác nhận đăng ký.');
    }


    public function confirmRegistration($token)
    {
        $user = User::where('email_verification_token', $token)->firstOrFail();

        $user->update(['email_verification_token' => null]);

        Auth::login($user);

        return redirect()->route('home.index')->with('status', 'Xác nhận thành công! Bạn đã được đăng nhập.');
    }
}
