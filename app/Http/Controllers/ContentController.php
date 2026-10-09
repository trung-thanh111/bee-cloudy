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


    public function view()
    {
        $template = 'backend.comment.index';
        return view('backend.dashboard.layout', compact(
            'template',
        ));
    }

    public function getdata()
    {
        $data = Content::join('users', 'users.id', 'contents.user_id')
            ->select('users.name as ten_kh', 'contents.*',)
            ->get();

        return response()->json([
            'data'    => $data,
        ]);
    }
    public function likedata()
    {
        $contentLikes = Content::join('users', 'users.id', '=', 'contents.user_id')
            ->select('users.name as ten_kh', 'contents.*')
            ->orderByDESC('contents.like_count')
            ->get();

        return response()->json([
            'like_count' => $contentLikes,
        ]);
    }

    public function like(Request $request)
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
            $content = Content::where('id', $request->id)->first();

            if ($content) {
                $sessionKey = 'content_like_' . $content->id;
                $isLiked = session()->has($sessionKey);

                if ($isLiked) {
                    $content->like_count -= 1;
                    session()->forget($sessionKey);
                } else {
                    $content->like_count += 1;
                    session()->put($sessionKey, true);
                }
                $content->save();

                return response()->json([
                    'status' => true,
                    'like_count' => $content->like_count
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Bài viết không tồn tại.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi thực hiện chức năng like.',
            ], 500);
        }
    }


    public function checkIfRated(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }

        $content = Content::where('id', $request->id)->first();

        if ($content) {
            $sessionKey = 'content_like_' . $content->id;
            $isLiked = session()->has($sessionKey);

            return response()->json([
                'status' => true,
                'liked' => $isLiked,
                'like_count' => $content->like_count
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bài viết không tồn tại.',
            ]);
        }
    }

    public function updateadmin(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $data = Content::where('id', $request->id)->first();
            if ($data) {
                $data->content = $request->content;
                $data->save();
                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã chỉnh sửa bài đánh giá .',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi chỉnh sửa đánh giá.',
            ], 500);
        }
    }
    public function deleteadmin(Request $request)
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
                'message'   => 'Đã Xóa bài đánh giá .',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi chỉnh sửa đánh giá.',
            ], 500);
        }
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
            } else {
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

    public function loadCommentsPage()
    {
        $comments = Comment::paginate(10);  // Phân trang 10 bình luận mỗi trang
        return response()->json($comments); // Trả về bình luận dưới dạng JSON
    }
}
