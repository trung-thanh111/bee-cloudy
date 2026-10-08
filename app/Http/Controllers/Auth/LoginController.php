<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
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
}
