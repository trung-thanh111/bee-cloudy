<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserCatalogue
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            $user = Auth::user();
            if($user->user_catalogue_id != 2 ){
                flash()->warning('Xin lỗi! Bạn không thể truy cập trang này.');
                return redirect()->back();            }
        }
        return $next($request);
    }
}
