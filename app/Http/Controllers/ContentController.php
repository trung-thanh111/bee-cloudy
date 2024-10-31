<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function view_content()
    {
        return view('fontend.Content.index');
    }
    public function data()
    {
        $data = Content::join('users', 'users.id', 'contents.user_id')
            ->select('users.name', 'contents.*')
            ->orderByDESC('contents.id')
            ->get();
        
        $commentCount = Content::count();

        return response()->json([
            'data'          => $data,
            'comment_count' => $commentCount,
        ]);
    }


    public function create(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $user = Auth::user();
            Content::create([
                'content'       => $request->content,
                'img'           => $request->img,
                'date'          => Carbon::now(),
                'user_id'       => $user->id,
            ]);
            return response()->json([
                'status'    => true,
                'message'   => 'Đã thêm bài viết mới.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi đánh giá sản phẩm.',
            ], 500);
        }
    }
    public function delete(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            Content::find($request->id)->delete();
            return response()->json([
                'status'    => true,
                'message'   => 'Đã xóa bài viết .',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi thêm bài biết mới.',
            ], 500);
        }
    }
    public function update(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi gửi bình luận.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $data = Content::where('id', $request->id)->first();
            if ($data->edit_count >= 1) {
                return response()->json([
                    'code' => false,
                    'message' => 'Bạn đã chỉnh sửa bình luận này',
                ], 500);
                
            }else{
                // $data->update([
                //     // 'content'       => $request->content,
                //     // 'img'           => $request->img,
                // ]);
                $data->content = $request->input('content');
                $data->edit_count += 1;
                $data->save();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã chỉnh sửa bình luận.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi chỉnh sửa bình luận này.',
            ], 500);
        }
    }
}
