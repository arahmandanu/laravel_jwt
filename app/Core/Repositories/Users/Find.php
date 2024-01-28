<?php

declare(strict_types=1);

namespace App\Core\Repositories\Users;

use App\Http\Resources\Api\User\UserEntities;
use App\Models\User;
use Monad\FTry;
use Monad\FTry\Success;

class Find
{
    private $id;
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function call()
    {
        return $this->getUser();
    }

    private function getUser()
    {
        $user = User::find($this->id);
        if (!$user) {
            return new Success([]);
        }

        return new Success(new UserEntities($user));
    }
}
