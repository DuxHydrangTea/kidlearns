<?php 
namespace App\Observers;

use Storage;
trait DeleteFileTrait
{
 
    public function deleteFile(string $filePath): void
    {
        // check is string start with "storage", if so, remove "storage" from the beginning
        if (str_starts_with($filePath, 'storage')) {
            $filePath = substr($filePath, 7); // remove "storage" from the beginning
        }
        // check if file exists
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
    }

    public function deleteFiles(array $filePaths): void
    {
        foreach ($filePaths as $filePath) {
            $this->deleteFile($filePath);
        }
    }
}