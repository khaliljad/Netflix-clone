<?php

namespace App\Http\Middleware;

use App\Profile;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfil
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
        return $next($request);

    }
}
