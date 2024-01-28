<?php

declare(strict_types=1);

namespace App\Core\Repositories\Users;

use App\Http\Resources\Api\User\UserCollection;
use App\Models\User;
use Monad\FTry;
use Monad\FTry\Success;

class Where
{
    public $query, $page, $limit;
    public function __construct(string $query = null, string $page = '0', string $limit = '10')
    {
        $this->query = $query;
        $this->page = $page;
        $this->limit = $limit;
    }

    public function call()
    {
        return FTry::with($this->listUsers($this->query, $this->page, $this->limit));
    }

    private function listUsers($query, $page, $limit)
    {
        $data = User::when($query, function ($exe, $query) {
            return $exe->where('name', 'like', "$query%");
        })
            ->paginate($limit);

        return new Success(new UserCollection($data));
    }
}
