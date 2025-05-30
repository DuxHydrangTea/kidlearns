<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonExamHistory extends Model
{
    //
    protected $table = 'lesson_exam_histories';
    protected $guarded = [];

    public function lesson(){
        return $this->belongsTo(Lesson::class,'lesson_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function set(){
        return $this->belongsTo(Set::class,'set_id','id');
    } 
    
}
