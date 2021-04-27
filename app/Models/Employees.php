<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    
    public $timestamps = true;

    protected $fillable = [
        'id','name', 'username', 'email', 'status', 'role', 'hours_per_week'
    ];
}
