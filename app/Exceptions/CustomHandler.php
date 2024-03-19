<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Traits\Response\Handler;
use Illuminate\Http\Request;

class CustomHandler
{
    use Handler;

    private static $exception;

    private static $request;

    public function __construct(Request $request, \Exception $exception)
    {
        self::$exception = $exception;
        self::$request = $request;
    }

    public function call()
    {
        $data = null;
        $message = self::$exception->getMessage();
        switch (get_class(self::$exception)) {
            case 'Error':
            case 'Illuminate\Database\QueryException':
            case 'ErrorException':
                $code = 500;
                break;
            case 'Illuminate\Database\Eloquent\ModelNotFoundException':
            case 'Symfony\Component\HttpKernel\Exception\NotFoundHttpException':
                $code = 404;
                $message = 'Resource not Found!';
                break;
            case 'Illuminate\Validation\ValidationException':
                $data = self::$exception->errors();
                $code = 422;
                break;
            case 'Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException':
                $message = "You don't have access for this request!";
                $code = 401;
                break;
            case 'Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException':
            case "Symfony\Component\HttpKernel\Exception\HttpException":
                $code = self::$exception->getStatusCode();
                break;
            case 'Tymon\JWTAuth\Exceptions\TokenExpiredException':
                $code = 401;
                break;
            case 'Tymon\JWTAuth\Exceptions\TokenInvalidException':
                $message = "Invalid Token!";
                $code = 401;
                break;
            default:
                $code = 400;
        }

        return $this->responseHandler($message, $code, $data);
    }

    private function responseHandler(string $message = '', int $code = 400, $data = null)
    {
        return $this->response($data, false, $message, $code);
    }
}
