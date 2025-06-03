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

    function getFileColumns (){
        return [
            $this->file_path,
        ];
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
