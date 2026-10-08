<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index () {
        $template = 'fontend.home.home.index';
        return view('fontend.home.layout', compact(
            'template',
        ));
    }
}
