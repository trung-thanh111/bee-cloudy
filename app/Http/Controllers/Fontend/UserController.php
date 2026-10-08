<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\UserService;
use Illuminate\Http\Request;

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
