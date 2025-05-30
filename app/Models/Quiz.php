<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizes';
    protected $fillable = [
        'user_id',
        'subject_id',
        'class_id',
        'course_id',
        'title',
        'description',
        'thumbnail',
        'status',
        'duration',
        'level',
    ];

    // Relationships
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

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class, 'quiz_id');
    }

    // Accessors
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }
}