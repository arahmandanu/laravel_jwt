<?php

namespace App\Service;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth;

class AuthService extends BaseMiddleware
{
    public function meByToken($token)
    {
        JWTAuth::parseToken()->authenticate();
    }
}
