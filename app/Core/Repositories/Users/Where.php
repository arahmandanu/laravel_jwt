<?php

declare(strict_types=1);

namespace App\Core\Repositories\Users;

use App\Core\Repositories\AbstractRepositories;
use App\Http\Resources\Api\User\UserCollection;
use App\Models\User;
use Monad\FTry;
use Monad\FTry\Success;

class Where extends AbstractRepositories
{
    public $query;
    public function __construct($query = [])
    {
        $this->query = $this->FormatQuery($query);
    }

    public function call()
    {
        return $this->listUsers($this->query);
    }

    private function listUsers($query)
    {
        $data = User::when($query['query'], function ($exe, $paramsQuery) {
            return $exe->where('name', 'like', "$paramsQuery%");
        })
            ->orderBy('name', $query['order'])
            ->paginate($query['limit']);

        return new Success(new UserCollection($data));
    }
}
