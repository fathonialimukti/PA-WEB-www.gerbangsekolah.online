<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'teacher_id',
        'gender',
        'phone',
        'subject',
        'dateofbirth',
        'cityofbirth',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class,'teacher_grade');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class,);
    }
}
