<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index () {
        
        $template = 'backend.dashboard.home.index';
        return view('backend.dashboard.layout', compact(
            'template',
        ));
    }
}
