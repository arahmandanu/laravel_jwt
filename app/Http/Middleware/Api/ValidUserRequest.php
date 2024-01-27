<?php

declare(strict_types=1);

namespace App\Http\Middleware\Api;

use Closure;
use Exception;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

use Monad\FTry;
use Monad\FTry\Failure;
use Monad\FTry\Success;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class ValidUserRequest extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $check = FTry::with($this->validate($request));
        if (!$check->isSuccess()) $check->pass();

        return $next($request);
    }

    private function validate($request)
    {
        $this->checkForToken($request);
        JWTAuth::parseToken()->authenticate();
        if (!auth()->user()) {
            return new Failure(new UnauthorizedHttpException('jwt-auth', 'Failed to authorized!'));
        }

        return new Success(true);
    }
}
