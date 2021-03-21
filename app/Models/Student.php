<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'student_id',
        'class_id',
        'roll_number',
        'gender',
        'phone',
        'dateofbirth',
        'cityofbirth',
        'address',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function grade() 
    {
        return $this->belongsTo(Grade::class, 'class_id');
    }

    public function assignment()
    {
        return $this->hasMany(Assignment_file::class);
    }

    // public function attendances() 
    // {
    //     return $this->hasMany(Attendance::class);
    // }
}
