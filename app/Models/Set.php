<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $guarded = [];
    protected $table = 'sets';
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function lessonExams(){
        return $this->hasMany(LessonExam::class);
    }

    public function scopeByLesson($query, $lessonId){
        return $query->where('lesson_id', $lessonId);
    }

}
