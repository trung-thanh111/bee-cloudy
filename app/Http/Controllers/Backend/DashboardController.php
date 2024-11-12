<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;

class DashboardController extends Controller
{
    protected $userService;
    protected $orderService;
    protected $productServices;
    public function __construct(
        UserService $userService,
        OrderService $orderService,
        ProductService $productServices,
    ) {
        $this->userService = $userService;
        $this->orderService = $orderService;
        $this->productServices = $productServices;
    }
    public function index () {
        $totalE = $this->orderService->totalMoneyOrder();
        $countTotalOrder = $this->orderService->countTotalOrder();
        // -- //
        $countUserNew = $this->userService->countUserNew();
        $countUserAll = $this->userService->countUserAll();
        // -- // conversion rate
        $countUserMonth = $this->userService->countUserNewMonth();
        $countOrderMonth = $this->orderService->countTotalOrderMonth();
        $conversionRate = 0;
        if($countUserMonth > 0 && $countOrderMonth > 0){
            $conversionRate = ($countOrderMonth / $countUserMonth ?? 1) * 100; // tính theo %
        }
        $conversionRateYear = 0;
        if($countUserAll > 0 && $countTotalOrder > 0){
            $conversionRateYear = ($countTotalOrder / $countUserAll) * 100; 
        }
        // order 12 month
        $orderGraph = $this->orderService->countOrderFul12Month();
        $moneyGraph = $this->orderService->countMoneyFul12Month();
        
        $orderRecents = $this->orderService->orderRecent();
        // -- // 
        $productSalers = $this->productServices->productSaler();
        $template = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'totalE',
            'countTotalOrder',
            'countUserNew',
            'countUserAll',
            'conversionRate',
            'conversionRateYear',
            'orderGraph',
            'moneyGraph',
            'orderRecents',
            'productSalers',
        ));
    }
}
