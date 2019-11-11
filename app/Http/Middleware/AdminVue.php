<?php

namespace App\Http\Middleware;

use Closure;

class AdminVue
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
        return response()->view('layouts.admin');
    }
}
