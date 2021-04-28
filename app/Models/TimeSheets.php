<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheets extends Model
{
    use HasFactory;

    protected $fillable = [
       'employee_id', 'client_id', 'project_id', 'name_client', 'project', 'description', 'hours_per_week', 'total_time', 'date', 'user'
    ];
}
