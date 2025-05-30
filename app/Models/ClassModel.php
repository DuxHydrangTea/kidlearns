<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ClassModel extends Model
{
    //
    protected $guarded = [];
    protected $table = 'classes';

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

    // Scopes
    public function scopeActive(Builder $query)
    {
        return $query->whereHas('lessons');
    }
}
