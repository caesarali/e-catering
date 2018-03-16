<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // if (!Auth::check() || !Auth::user()->hasRole($role)) {
        //     Auth::logout();
        //     return redirect('/admin/login');
        // }
        if (!Auth::check()) {
            return redirect('/admin/login');
        } elseif (!Auth::user()->hasRole($role)) {
            if (Auth::user()->hasAdmin()) {
                return redirect('/admin/404');
            }
            Auth::logout();
            return redirect('/admin/login');
        }
        return $next($request);
    }
}
