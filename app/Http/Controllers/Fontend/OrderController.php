<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\FontendController;
use App\Models\Order;
use App\Repositories\CartRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ProductRepository;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends FontendController
{
    protected $productRepository;
    protected $cartRepository;
    protected $cartService;

    public function __construct(
        CartRepository $cartRepository,
        ProductRepository $productRepository,
        CartService $cartService,
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
    }
    

    public function checkout(){
        $carts = $this->cartService->all();
        // dd($carts);
        return view('fontend.order.checkout', compact(
            'carts'
        ));

    }
}
