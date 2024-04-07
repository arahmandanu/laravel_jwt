<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentification\JwtLoginPostRequest;
use App\Http\Requests\Authentification\JwtRefreshPostRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Monad\FTry;
use Monad\FTry\Failure;
use Monad\FTry\Success;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Manager;

class AuthenticationController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(JwtLoginPostRequest $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = [
            'access_token' => auth('api')->tokenById(auth()->user()->id),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()  * 60
        ];

        return $this->response($data);
    }

    public function logout()
    {
        $execute = FTry::with(function () {
            auth('api')->logout();
            return new Success(true);
        });
        if (!$execute->isSuccess()) $execute->pass();

        return $this->response(null, 'Success logout account!');
    }

    public function refreshToken(Request $request)
    {
        $before = auth('api')->tokenById(auth()->user()->id);
        $execute = FTry::with(function () {
            auth('api')->refresh();
            return new Success(true);
        });
        if (!$execute->isSuccess()) $execute->pass();

        $data = [
            'access_token' => auth('api')->tokenById(auth()->user()->id),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()  * 60
        ];
        return $this->response($data);
    }
}
