<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class PermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->hasRole('admin')){
            return $next($request);
        }
        return redirect()->route('admin.blank')->with('danger', ' Bạn không có quyền sử dụng chức năng này!');

    }
}
