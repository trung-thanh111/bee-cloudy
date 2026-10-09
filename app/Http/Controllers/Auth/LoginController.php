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
            flash()->success('Đăng nhập thành công!');
            return $user->user_catalogue_id >= 2
                ? redirect()->route('dashboard.index')
                : redirect()->route('home.index');
        } else {
            flash()->error('Thất bại. Email hoặc mật khẩu không đúng!');
            return redirect()->back()->withInput($request->except('password'));
        }
    }

    // Chuyển hướng đến Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $googleUser->id)->orWhere('email', $googleUser->email)->first();

            if ($findUser) {
                Auth::login($findUser);
                flash()->success('Đăng nhập thành công!');
                return redirect()->intended('home');
            } else {
                $user = User::updateOrCreate([
                    'email' => $googleUser->email,
                ], [
                    'name' => $googleUser->name,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)),
                ]);

                Auth::login($user);
                flash()->success('Đăng nhập thành công!');
                return redirect()->route('home.index');
            }
        } catch (\Exception $e) {
            flash()->error('Đăng nhập Google thất bại, vui lòng thử lại.');
            return redirect()->route('auth.login');
        }
    }

    // Chuyển hướng đến Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Xử lý callback từ Facebook
    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Kiểm tra nếu không lấy được thông tin người dùng
            if (empty($facebookUser->id) || empty($facebookUser->email)) {
                flash()->error('Không thể lấy thông tin từ Facebook. Vui lòng thử lại.');
                return redirect()->route('auth.login');
            }

            // Kiểm tra xem người dùng đã có trong cơ sở dữ liệu chưa
            $findUser = User::where('facebook_id', $facebookUser->id)
                ->orWhere('email', $facebookUser->email)
                ->first();

            if ($findUser) {
                Auth::login($findUser);
                flash()->success('Đăng nhập thành công!');
                return redirect()->intended('home');
            } else {
                $user = User::create([
                    'name' => $facebookUser->name ?? 'Người dùng Facebook', // Dự phòng tên
                    'email' => $facebookUser->email,
                    'facebook_id' => $facebookUser->id,
                    'password' => bcrypt(Str::random(16))
                ]);

                Auth::login($user);
                flash()->success('Đăng nhập thành công!');
                return redirect()->intended('home.index');
            }
        } catch (\Exception $e) {
            flash()->error('Đăng nhập Facebook thất bại, vui lòng thử lại.');
            return redirect()->route('auth.login');
        }
    }
}
