<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonProgress extends Model
{
    //
    protected $guarded = [];
    
    protected $table = 'lesson_progress';
    
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeIsFinished(){
        return $this->progress >= 75;
    }

 


}
