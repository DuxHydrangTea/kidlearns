<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class Lesson extends Model
{
    //
    protected $guarded = [];
    


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

    public function lessonType() {
        return $this->belongsTo(LessonType::class);
    }


    public function lessonProgress(){
        return $this->hasOne(LessonProgress::class);
    }

    public function getMyLessonProgressAttribute(){
        $lessonProgress = LessonProgress::where('lesson_id', $this->id)->where('user_id', auth()->user()->id)->first();
        return $lessonProgress;
    }

    public function sets(){
        return $this->hasMany(Set::class);
    }
    public function exams()
    {
        return $this->hasMany(LessonExam::class);
    }

    // Scopes
    public function scopeForClass(Builder $query, $classId)
    {
        return $query->where('class_id', $classId);
    }

    public function scopeForSubject(Builder $query, $subjectId)
    {
        return $query->where('subject_id', $subjectId);
    }


    public function getTagsAttribute(){
        return explode(',', $this->attributes['tags']);
    }

    public function getDocumentsAttribute(){
        $documents = json_decode($this->attributes['documents'] ?? '');
        if(!$documents){
            return [];
        }
        return $documents;
    }

    public function isVideoMp4(){
        return $this->video_type == 'mp4';
    }

    // public function getVideoPathAttribute(): string{
    //     return $this->getPath($this->attributes['video_path']);
    // }

    // public function getPath($path){
    //     return asset( $path);
    // }

    public function getSetByDifficulty($difficulty){
        return $this->sets()->where('difficulty', $difficulty)->first();
    }

}
