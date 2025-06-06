<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentSlide extends Model
{
    //\
    protected $fillable = [
        'document_id',
        'image_path',
    ];
    protected $table = 'document_slides';
    public function documents() {
        return $this->belongsTo(Document::class);
    }
}
