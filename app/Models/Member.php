<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = [];

    // Constants for roles
    const ROLE_STUDENT = 1;
    const ROLE_TEACHER = 2;

    // Accessors
    public function getRoleNameAttribute()
    {
        return $this->role === self::ROLE_TEACHER ? 'Teacher' : 'Student';
    }
}