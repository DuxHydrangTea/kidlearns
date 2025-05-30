<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $guarded = [];
    protected $table = 'quiz_questions';


    // Relationships
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    // Accessors/Mutators
    public function setAnswersAttribute($value)
    {
        $this->attributes['answers'] = is_array($value) ? json_encode($value) : $value;
    }
}