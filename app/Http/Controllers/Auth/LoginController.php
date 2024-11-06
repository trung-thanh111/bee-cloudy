<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use Laravel\Socialite\Facades\Socialite;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->user_catalogue_id >= 2) {
                flash()->success('Đăng nhập thành công!');
                return redirect()->route('dashboard.index');
            } else {
                flash()->success('Đăng nhập thành công!');
                return redirect()->route('home.index');
            }
        } else {
            flash()->error('Thất bại. Email hoặc mật khẩu không đúng!');
            return redirect()->back()->withInput($request->except('password'));
        }
    }

    // Phương thức để chuyển hướng người dùng tới Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Phương thức xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('home');
            } else {
                $user = User::updateOrCreate([
                    'email' => $user->email,
                ], [
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => bcrypt(Str::random(16)),
                ]);

                Auth::login($user);
                flash()->success('Đăng nhập thành công!');
                return redirect()->route('home.index');
            }
        } catch (\Exception $e) {
            return redirect()->route('auth.login')->with('error', 'Đăng nhập Google thất bại, Vui lòng thử lại.');
        }
    }
}
