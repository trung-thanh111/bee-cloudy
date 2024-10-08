<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FontendController;
use App\Models\Cart;
use App\Repositories\CartRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CartCatalogueRepository;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends FontendController
{
    protected $cartRepository;
    protected $brandRepository;
    protected $cartService;

    public function __construct(
        CartRepository $cartRepository,
        BrandRepository $brandRepository,
        CartService $cartService,
    ) {
        $this->cartRepository = $cartRepository;
        $this->brandRepository = $brandRepository;
        $this->cartService = $cartService;
    }

    public function addToCart(){
        echo 12334;
    }
    
}
