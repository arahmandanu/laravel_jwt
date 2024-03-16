<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\UserRoles\UserRolesCollection;

class UserEntities extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'roles' => $this->roles->pluck('name')
        ];
    }
}
