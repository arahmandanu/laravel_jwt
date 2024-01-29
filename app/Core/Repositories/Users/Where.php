<?php

declare(strict_types=1);

namespace App\Core\Repositories\Users;

use App\Http\Resources\Api\User\UserCollection;
use App\Models\User;
use Monad\FTry;
use Monad\FTry\Success;

class Where
{
    public $query, $page, $limit, $order;
    public function __construct(string $query = null, string $page = '0', string $limit = '10', string $order = 'asc')
    {
        $this->query = $query;
        $this->page = $page;
        $this->limit = $limit;
        $this->order = $order;
    }

    public function call()
    {
        return $this->listUsers($this->query, $this->page, $this->limit, $this->order);
    }

    private function listUsers($query, $page, $limit, $order)
    {
        $data = User::when($query, function ($exe, $query) {
            return $exe->where('name', 'like', "$query%");
        })
            ->orderBy('name', $order)
            ->paginate($limit);

        return new Success(new UserCollection($data));
    }
}
