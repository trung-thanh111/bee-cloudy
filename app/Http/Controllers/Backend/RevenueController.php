<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class RevenueController extends Controller
{
    public function index(Request $request)
    {
        $template = 'backend.revenue.index';
        return view('backend.dashboard.layout', compact(
            'template',
        ));
    }

    public function Thongke(Request $request)
    {
        $data = Order::where('status', 'completed')
            ->where('payment', 'paid')
            ->where('status', 'completed')
            ->where('paid_at', '!=', null)
            ->whereDate('created_at', '>=', $request->tu_ngay)
            ->whereDate('created_at', '<=', $request->den_ngay)
            ->get();

        $tong_tien  = Order::where('status', 'completed')
            ->where('payment', 'paid')
            ->where('status', 'completed')
            ->where('paid_at', '!=', null)
            ->whereDate('created_at', '>=', $request->tu_ngay)
            ->whereDate('created_at', '<=', $request->den_ngay)
            ->sum('total_amount');
            
        $Don_hang  = Order::where('status', 'completed')
            ->where('payment', 'paid')
            ->where('status', 'completed')
            ->where('paid_at', '!=', null)
            ->whereDate('created_at', '>=', $request->tu_ngay)
            ->whereDate('created_at', '<=', $request->den_ngay)
            ->count('code');
        return response()->json([
            'data' => $data,
            'tong_tien' => $tong_tien,
            'Don_hang' => $Don_hang,

        ]);
    }
}
