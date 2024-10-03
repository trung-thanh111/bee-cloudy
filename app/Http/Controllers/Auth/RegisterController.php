<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // sử dụng hash password của laravel
        ]);
        event(new Registered($user));

        Auth::login($user);
        flash()->success('Đăng ký thành công!');
        return redirect()->route('home.index');
    }
}
