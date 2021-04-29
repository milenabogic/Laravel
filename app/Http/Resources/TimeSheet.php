<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeSheet extends JsonResource
{
    public function toArray($request)
    {
        return [
            'employee_id' => $this->employee_id,
            'client_id'=> $this->client_id,
            'project_id' => $this->project_id,
            'name_client' => $this->name_client,
            'projects' => $this->projects,
            'description' => $this->description,
            'hours_per_week' => $this->hours_per_week,
            'total_time'=> $this->total_time,
            'date' => $this->date,
            'user' => $this->user
        ];
    }
}