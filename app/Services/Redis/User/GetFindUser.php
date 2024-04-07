<?php

declare(strict_types=1);

namespace App\Services\Redis\User;

use App\Http\Resources\Api\User\UserEntities;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Monad\FTry;
use Monad\FTry\Failure;
use Monad\FTry\Success;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class GetFindUser
{
    public $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function call()
    {
        $user =  FTry::with(function () {
            return $this->getUser($this->id);
        });

        return new Success($user);
    }

    private function getUser($id)
    {
        $user = Cache::remember('users' . $id, 30, function () use ($id) {
            return User::find($id);
        });
        if (!$user || is_null($user)) return new Failure(new UnprocessableEntityHttpException('Resource Not Found!'));

        return new Success(new UserEntities($user));
    }
}
