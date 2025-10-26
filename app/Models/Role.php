<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    //
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_role', 'role_id', 'employee_id');
    }
}
