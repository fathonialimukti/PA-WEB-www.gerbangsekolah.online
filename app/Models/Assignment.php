<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'grade_id',
        'teacher_id',
        'title',
        'description',
    ];

    public function grade() 
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function files() 
    {
        return $this->hasMany(Assignment_file::class);
    }
}
