<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FontendController;

use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;

class OrderController extends FontendController
{

    protected $orderService;

    public function __construct(

        OrderService $orderService,
    ) {

        $this->orderService = $orderService;
    }

    // update field note
    public function edit(Request $request)
    {
        try {
            $updated = $this->orderService->update($request);
            if ($updated) {
                return response()->json([
                    'code' => 10,
                    'message' => 'Cập nhật thành công.',
                ]);
            } else {
                return response()->json([
                    'code' => 11,
                    'message' => 'Không thể cập nhật. Vui lòng thử lại!',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi cập nhật giỏ hàng.',
            ], 500);
        }
    }
    public function updateStatus(Request $request)
    {
        try {
            $updated = $this->orderService->update($request);
            if ($updated) {
                return response()->json([
                    'code' => 10,
                    'message' => 'Cập nhật thành công.',
                    'redirect' => 'back',
                ]);
            } else {
                return response()->json([
                    'code' => 11,
                    'message' => 'Không thể cập nhật giỏ hàng.',
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 11,
                'message' => 'Có lỗi xảy ra khi cập nhật giỏ hàng.',
            ], 500);
        }
    }
}
