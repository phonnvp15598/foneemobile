<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionAuthor
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
        if(Auth::user()->hasAnyRoles(['admin','author'])){
            return $next($request);
        }
        return redirect()->route('admin.blank')->with('danger', ' Bạn không có quyền sử dụng chức năng này!');
    }
}
