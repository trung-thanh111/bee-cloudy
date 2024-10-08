<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\FontendController;

use Illuminate\Http\Request;
use App\Repositories\CartRepository;
use App\Services\CartService;

class CartController extends FontendController
{
    protected $cartRepository;
    protected $cartService;

    public function __construct(
        CartRepository $cartRepository,
        CartService $cartService,
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartService = $cartService;
    }
    public function addToCart(Request $request){
       $this->cartService->create($request);
    }
    
    
}
