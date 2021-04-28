<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project', 'name_client', 'name_employee', 'status_project', 'archived_project', 'employee_id', 'client_id'
    ];
}
