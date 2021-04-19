<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employees extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email'=> $this->email,
            'status' => $this->status,
            'role' => $this->role,
            'hours_per_week' => $this->hours_per_week,
            'detail' => $this->detail
        ];
    }
}
