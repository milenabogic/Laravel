<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSheets extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'project', 'description', 'hours_per_week', 
        'total_time', 'date', 'user'
    ];
}
