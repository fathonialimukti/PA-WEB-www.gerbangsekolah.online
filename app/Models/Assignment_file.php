<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment_file extends Model
{
    protected $fillable = [
        'assignment_id',
        'student_id',
        'file',
        'note',
        'score',
    ];

    public function assignment() 
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function student() 
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
