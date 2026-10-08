<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    protected $cartRepository;
    protected $cartCatalogueRepository;
    public function __construct(
        CartService $cartService,
        CartRepository $cartRepository,

    ) {
        $this->cartService = $cartService;
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('fontend.cart.index', compact('cart'));
    }
    public function store(Request $request) {
        echo 123; die();
    }
}
