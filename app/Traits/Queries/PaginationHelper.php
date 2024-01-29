<?php

declare(strict_types=1);

namespace App\Traits\Queries;


trait PaginationHelper
{
    public function FormatQuery($request): array
    {
        $data = [
            'limit' => 10,
            'page' => 1,
            'query' => '',
            'order' => 'asc'
        ];
        $data = array_merge($data, $request);

        return $data;
    }
}
