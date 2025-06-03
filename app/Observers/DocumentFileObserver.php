<?php

namespace App\Observers;

use App\Models\DocumentFile;
use Storage;
class DocumentFileObserver
{
    //
    use DeleteFileTrait;
    public function deleted(DocumentFile $documentFile)
    {
        $this->deleteFiles($documentFile->getFileColumns());
    }
}
