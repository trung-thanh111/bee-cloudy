<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite; // Import Socialite
use App\Models\User; // Import model User
use Illuminate\Http\Request;

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
                return redirect()->intended('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Đăng nhập Google thất bại, vui lòng thử lại.');
        }
    }
}
