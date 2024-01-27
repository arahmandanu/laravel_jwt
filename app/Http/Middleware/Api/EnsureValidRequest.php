<?php

declare(strict_types=1);

namespace App\Http\Middleware\Api;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Monad\FTry;
use Monad\FTry\Failure;

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
        $check = FTry::with($this->isValidRequest($request));
        if (!$check->isSuccess()) $check->pass();

        return $next($request);
    }

    private function isValidRequest($request)
    {
        if (!$request->expectsJson()) {
            return new Failure(new Exception('Invalid request!', 400));
        }
    }
}
