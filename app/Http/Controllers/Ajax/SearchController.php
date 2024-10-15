<?php
namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function suggestion (Request $request){
        $keyword = $request->input('keyword');
        
    }
}
