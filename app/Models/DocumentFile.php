<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFile extends Model
{
    //
    protected $table = 'document_files';
    protected $fillable = [
        'name',
        'file_path',
        'document_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
