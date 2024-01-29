<?php

declare(strict_types=1);

namespace App\Traits\Queries;


trait PaginationHelper
{
    public function FormatQuery($request): array
    {
        $data = \collect([
            'limit' => 10,
            'page' => 1,
            'query' => '',
            'order' => 'asc'
        ]);
        $data = $data->merge($request);
        return $data->toArray();
    }
}
