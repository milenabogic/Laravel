<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeSheets extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'projects' => $this->projects,
            'description' => $this->description,
            'hours_per_week' => $this->hours_per_week,
            'total_time'=> $this->total_time,
            'date' => $this->status,
            'archived' => $this->date->format('d/m/Y'),
            'detail' => $this->detail
        ];
    }
}