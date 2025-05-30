<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonExam extends Model
{
    //
    protected $guarded = [];
    
    protected $casts = [
        'answers' => 'array',
    ];

    // Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function set()
    {
        return $this->belongsTo(Set::class);
    }

    // Accessors/Mutators
    public function setAnswersAttribute($value)
    {
        $this->attributes['answers'] = is_array($value) ? json_encode($value) : $value;
    }
}
