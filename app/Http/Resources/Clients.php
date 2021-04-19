<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Clients extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city'=> $this->city,
            'post_code' => $this->post_code,
            'state' => $this->state,
            'detail' => $this->detail
        ];
    }
}