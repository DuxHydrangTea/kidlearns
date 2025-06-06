<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
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

    // Accessors/Mutators
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/'.$this->thumbnail) : null;
    }

    public function getTagsAttribute($value){
        return explode(',', $this->attributes['tags']);
    }

    public function documentFiles()
    {
        return $this->hasMany(DocumentFile::class);
    }

    public function documentSlides(){
        return $this->hasMany(DocumentSlide::class);
    }

    public static function getAllTypes () {
        return [
          'lesson' => 'Bài giảng',
          'worksheet' => 'Bài tập',
          'exam' => 'Đề kiểm tra',
          'reference' => 'Tài liệu tham khảo',
          'other' => 'Khác',
        ];
    }
}