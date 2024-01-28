<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authentification\JwtLoginPostRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Monad\FTry;
use Monad\FTry\Failure;
use Monad\FTry\Success;

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
        if (!$user = auth('api')->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = [
            'access_token' => $user,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL()  * 60
        ];

        return $this->response($data);
    }

    public function logout()
    {
        $execute = FTry::with(function () {
            if (auth('api')->logout()) {
                return new Success(true);
            } else {
                return new Failure(new Exception('Failed to logout!'));
            };
        });
        if (!$execute->isSuccess()) $execute->pass();

        return $this->response(null, 'Success logout account!');
    }
}
