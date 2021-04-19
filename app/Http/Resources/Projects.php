<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Projects extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'projects' => $this->projects,
            'client' => $this->client,
            'employee'=> $this->employee,
            'status' => $this->status,
            'archived' => $this->archived,
            'detail' => $this->detail
        ];
    }
}