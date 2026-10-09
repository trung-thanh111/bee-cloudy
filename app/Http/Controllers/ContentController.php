<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContentRequest;
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
            ->select('users.*', 'contents.*',)
            ->get();

        return response()->json([
            'data'    => $data,
        ]);
    }
    public function likedata()
    {
        $contentLikes = Content::join('users', 'users.id', '=', 'contents.user_id')
            ->select('users.name as ten_kh', 'contents.*')
            // ->orderByDESC('contents.like_count')
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
                    'code' => 10,
                    'like_count' => $content->like_count
                ]);
            } else {
                return response()->json([
                    'code' => 11,
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
                'code' => 10,
                'liked' => $isLiked,
                'like_count' => $content->like_count
            ]);
        } else {
            return response()->json([
                'code' => 11,
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
                    'code' => '10',
                    'message'   => 'Đã chỉnh sửa bài đánh giá.',
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
                'code' => '10',
                'message'   => 'Đã Xóa bài đánh giá.',
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
            ->select('users.*', 'contents.*')
            // ->orderByDESC('contents.id')
            ->get();

        $commentCount = Content::count();

        return response()->json([
            'data'          => $data,
            'comment_count' => $commentCount,
        ]);
    }
    public function create(ContentRequest $request)
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
                'code' => '10',
                'message'   => 'Đánh giá bài viết thành công.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi đánh giá bài viết.',
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
                'code' => '10',
                'message'   => 'Đánh giá đã được xóa!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi xóa.',
            ], 500);
        }
    }
    public function update(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi gửi đánh giá.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $data = Content::where('id', $request->id)->first();
            if ($data->edit_count >= 1) {
                return response()->json([
                    'code' => false,
                    'message' => 'Đánh giá đã được chỉnh sửa!',
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
                    'code' => '10',
                    'message'   => 'Đã chỉnh sửa đánh giá.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi chỉnh sửa đánh giá này.',
            ], 500);
        }
    }

    public function loadCommentsPage()
    {
        $comments = Content::paginate(10);  // Phân trang 10 đánh giá mỗi trang
        return response()->json($comments); // Trả về đánh giá dưới dạng JSON
    }
}
