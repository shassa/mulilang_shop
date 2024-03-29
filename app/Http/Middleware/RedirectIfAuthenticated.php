<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
            if (Auth::guard('admin')->check()) {
                return redirect(RouteServiceProvider::ADMIN);
            }
            if (Auth::guard('web')->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
        return $next($request);
    }
}
