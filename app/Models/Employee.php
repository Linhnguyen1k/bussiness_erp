<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'status',
        'image',
        'address',
        'date_of_birth',
        'gender',
        'joined_date',
        'city',
        'state',
        'country',
        'salary',
        'role_id',
    ];
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function role()
    {
        return $this->belongsToMany(Role::class, 'employee_role', 'employee_id', 'role_id');
    }
    public function checkins()
    {
        return $this->hasMany(Checkin::class);
    }
}
