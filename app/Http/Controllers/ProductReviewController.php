<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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


    public function view()
    {
        $template = 'backend.producreview.index';
        return view('backend.dashboard.layout', compact(
            'template',
        ));
    }

    public function getdata()
    {
        $data = ProductReview::join('users', 'users.id', 'product_reviews.user_id')
            ->join('products', 'products.id', 'product_reviews.id_products')
            ->select('users.name as ten_kh', 'product_reviews.*', 'products.name')
            ->get();

        return response()->json([
            'data'    => $data,
        ]);
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

            $commentCount = ProductReview::where('slug_products', $slug)->count();
            $totalStars = ProductReview::where('slug_products', $slug)->sum('publish');
            $averageStars = $commentCount > 0 ? ceil($totalStars / $commentCount) : 0;

            if ($data) {
                return response()->json([
                    'data' => $data,
                    'comment_count' => $commentCount,
                    'total_stars' => $totalStars,
                    'average_stars' => $averageStars,
                ]);
            }
        }
    }

    public function likedata($slug)
    {
        $product = ProductReview::join('users', 'users.id', 'product_reviews.user_id')
            // ->where('product_reviews.id_products', $product->id)
            ->where('slug_products', $slug)
            ->select('users.name', 'product_reviews.*')
            ->orderByDESC('content')
            ->get();
        
        

        return response()->json([
            'like_count' => $product,
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
            $product = ProductReview::where('id', $request->id)->first();
            if ($product) {
                $sessionKey = 'product_like_' . $product->id;
                $isLiked = session()->has($sessionKey);

                if ($isLiked) {
                    $product->like_count -= 1;
                    session()->forget($sessionKey);
                } else {
                    $product->like_count += 1;
                    session()->put($sessionKey, true);
                }
                $product->save();
                return response()->json([
                    'status' => true,
                    'like_count' => $product->like_count
                ]);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Có lỗi.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi đánh giá sản phẩm.',
            ], 500);
        }
    }

    public function checkIfRated($slug)
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
            $review = Product::where('slug', $slug)->first();
            if ($review) {
                $data = ProductReview::where('slug_products', $slug)
                    ->where('user_id', $user->id)
                    ->where('check',1)
                    ->first();
                if (!$data) {
                    return response()->json([
                        'status'    => true,
                        'message'   => 'chưa đánh giá',
                    ]);
                } else {
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Bạn đã đánh giá rồi',
                        'check' =>  $data->check
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi đánh giá sản phẩm.',
            ], 500);
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
            $review = ProductReview::where('slug_products', $slug)
                ->where('user_id', $user)
                ->first();
            if (!$review) {
                $product = Product::where('slug', $slug)->first();
                if ($product) {
                    $data = ProductReview::updateOrCreate([
                        'id_products' => $product->id,
                        'slug_products' => $slug,
                        'content' => $request->content,
                        'user_id' => $user->id,
                        'publish' => $request->publish,
                        'is_liked' =>1,
                        // 'check' => 1,

                    ]);
                    if ($data) {
                        $data->check = 1;
                        $data->save();
                        return response()->json([
                            'status' => true,
                            'message' => 'Đã đánh giá sản phấm.',
                            // 'check' =>  $data->check

                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Có lỗi.',
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'code' => false,
                'message' => 'Có lỗi xảy ra khi đánh giá sản phẩm.',
            ], 500);
        }
    }

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
            $user = Auth::user();
            if($user){
                $data = ProductReview::where('id', $request->id)
                ->where('user_id',$user->id)->first();
                if ($data) { 
                    $data->update([
                    'publish'  => $request->publish,
                    'content'  => $request->content,
                    ]);
                    $data->edit_count  += 1;
                    
                    $data->save();
                    
                    return response()->json([
                        'status'    => true,
                        'message'   => 'Đã chỉnh sửa bài đánh giá .',  
                    ]);
                }
            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => 'Có lỗi.',  
                ]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi chỉnh sửa đánh giá.',
            ], 500);
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
            $data = ProductReview::where('id', $request->id)->first();
            if ($data) {
                $data->publish = $request->publish;
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
            ProductReview::find($request->id)->delete();
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
}
