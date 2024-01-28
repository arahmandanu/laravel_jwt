<?php

namespace App\Http\Resources\Api\User;

use App\Http\Resources\Api\Pagination;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserEntities::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            parent::toArray($this->collection),
            new Pagination($this),
        ];
    }
}
