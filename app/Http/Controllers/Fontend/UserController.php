<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserFERequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\changePassMail;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function profile()
    {
        $user = Auth::user();
        return view('fontend.user_data.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('fontend.user_data.profile_edit', compact('user'));
    }

    public function updateProfile(UpdateUserFERequest $request)
    {
        try {
            $user = Auth::user();
            $payload = $request->only('name', 'phone', 'description', 'birthday', 'province_id', 'district_id', 'ward_id', 'address');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $path = 'userfiles/image/user/'; 
                $file->move($path, $filename);
                $relativePath = '/'.$path . $filename;
            
                $payload['image'] = $relativePath;
            } else {
                $payload['image'] = $user->image; 
            }
            
            $user->update($payload);
            
            return redirect()->route('profile.user')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi. Vui lòng thử lại!');
        }
    }

    public function changeViewProfile()
    {
        $user = Auth::user();
        return view('fontend.user_data.profile_changePass', compact('user'));
    }

    public function changeSubmitProfile(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không chính xác.');
        }

        // Tạo token ngẫu nhiên để xác nhận email
        $token = Str::random(64);

        // Lưu mật khẩu mới và token vào database
        $user->reset_token = $token;
        $user->new_password = bcrypt($request->password);
        $user->save();

        // Gửi email xác nhận
        try {
            $user->save();

            // Gửi email xác nhận
            $url = route('confirm.password.change', ['token' => $token]);
            Mail::to($user->email)->send(new changePassMail($url));

            return back()->with('success', 'Đã gửi email xác nhận thay đổi mật khẩu.');
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể gửi email xác nhận. Vui lòng thử lại sau.');
        }
        // $url = route('confirm.password.change', ['token' => $token]);
        // Mail::to($user->email)->send(new changePassMail($url));

        // return back()->with('success', 'Email xác nhận thay đổi mật khẩu đã được gửi.');
    }

    // Xác nhận đổi mật khẩu
    public function confirmPasswordChange($token)
    {
        // Tìm người dùng dựa vào token
        $user = User::where('reset_token', $token)->first();

        if (!$user) {
            return redirect()->route('profile.change-view')->with('error', 'Token không hợp lệ hoặc đã hết hạn.');
        }

        // Cập nhật mật khẩu và xóa token
        $user->password = $user->new_password;
        $user->new_password = null;
        $user->reset_token = null;
        $user->save();

        return redirect('/')->with('success', 'Mật khẩu đã được đổi thành công.');
    }
}
