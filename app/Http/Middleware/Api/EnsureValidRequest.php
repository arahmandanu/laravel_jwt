<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;

class EnsureValidRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            dd('error bang');
        }

        return $next($request);
    }
}
