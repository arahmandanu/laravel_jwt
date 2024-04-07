<?php

declare(strict_types=1);

namespace App\Services\Redis\User;

use Illuminate\Support\Facades\Redis;
use Monad\FTry;
use Monad\FTry\Success;

class DelFindUser
{
    public $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function call()
    {
        $user =  FTry::with(function () {
            return new Success(Redis::del('users', $this->id));
        });
        if (!$user->isSuccess()) $user->pass();

        return new Success($user);
    }
}
