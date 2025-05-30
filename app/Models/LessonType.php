<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonType extends Model
{
    //
    protected $guarded = [];

    public function lessons(){
        return $this->hasMany(Lesson::class)->orderBy('order', 'asc');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
