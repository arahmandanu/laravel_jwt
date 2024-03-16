<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\MyException\ScopeNotProvided;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Monad\FTry;
use Monad\FTry\Failure;
use Monad\FTry\Success;

class UserScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$scopes)
    {
        $validScope = FTry::with($this->validUserScope($scopes));
        if (!$validScope->isSuccess()) $validScope->pass();

        return $next($request);
    }

    public function validUserScope($scopes = [])
    {
        $user = auth()->user();
        if (!$user)  return new Failure(new AuthenticationException());
        if ($user->hasRole($scopes)) return new Success(true);

        return new Failure(new ScopeNotProvided());
    }
}
