<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{

    public function index()
    {
        return view('fontend.productreview.product_review');
    }
    public function view_order()
    {
        return view('fontend.information.index');
    }


    public function data($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $data = ProductReview::join('users', 'users.id', 'product_reviews.user_id')
                ->where('product_reviews.id_products', $product->id)
                ->select('users.name', 'product_reviews.*')
                ->orderByDESC('content')
                ->get();

            $commentCount = ProductReview::count();
            if ($data) {
                return response()->json([
                    'data' => $data,
                    'comment_count' => $commentCount,
                ]);
            }
        }
    }

    public function create(Request $request, $slug)
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
            $product = Product::where('slug', $slug)->first();
            // dd($product);
            if ($product) {
                $data = ProductReview::create([
                    'id_products' => $product->id,
                    'content' => $request->content,
                    'user_id' => $user->id,
                    'publish' => $request->publish,
                ]);
                if ($data) {
                    $data->save();
                    return response()->json([
                        'status' => true,
                        'message' => 'Đã đánh giá sản phấm.',

                    ]);
                }
                return response()->json([
                    'status' => false,
                    'message' => 'Có lỗi.',
                ]);
            }
            // return response()->json([
            //     'status'    => true,
            //     'message'   => 'Đã thêm đánh giá mới.',
            // ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi đánh giá sản phẩm.',
            ], 500);
        }
    }
    // public function delete(Request $request)
    // {
    //     if (!Auth::check()) {
    //         return response()->json([
    //             'code' => 11,
    //             'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
    //             'redirect' => route('auth.login'),
    //         ], 401);
    //     }
    //     try {
    //         ProductReview::find($request->id)->delete();
    //         return response()->json([
    //             'status'    => true,
    //             'message'   => 'Đã xóa bài đánh giá .',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'code' => 11,
    //             'message' => 'Có lỗi xảy ra khi xóa bài dánh giá.',
    //         ], 500);
    //     }
    // }
    public function update(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'code' => 11,
                'message' => 'Vui lòng đăng nhập trước khi sử dụng chức năng.',
                'redirect' => route('auth.login'),
            ], 401);
        }
        try {
            $data = ProductReview::where('id', $request->id)->first();
            if ($data) {
                $data->publish = $request->publish;
                $data->content = $request->input('content');
                $data->edit_count += 1;
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
}
