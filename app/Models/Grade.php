<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'class_name',
        'class_description',
        'virtual_classroom'
    ];

    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }

    public function teachers() 
    {
        return $this->belongsToMany(Teacher::class,'teacher_grade');
    }

    public function assignments() 
    {
        return $this->hasMany(Assignment::class);
    }
}
