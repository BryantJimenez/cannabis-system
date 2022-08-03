<?php

namespace App\Http\Middleware;

use Closure;
use App\Providers\RouteServiceProvider;

class AdminMiddleware
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
        if (auth()->check() && auth()->user()->hasPermissionTo('dashboard') && auth()->user()->state=='Activo') {
            return $next($request);
        }

        if (auth()->user()->state!='Activo') {
            auth()->logout();
        }
        
        return redirect()->route('login');
    }
}