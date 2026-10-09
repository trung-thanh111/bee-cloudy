<?php

namespace App\Http\Controllers\Fontend;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
    protected $cartService;

    public function __construct(
        CartService $cartService
    ) {
        $this->cartService = $cartService;
    }
    public function info(Request $request)
    {   
        return view('fontend.account.info');
    }
    
}
