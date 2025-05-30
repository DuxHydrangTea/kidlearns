<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $guarded = [];

    // Relationships
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}
