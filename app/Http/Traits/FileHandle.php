<?php

namespace App\Http\Traits;

use ZipArchive;
use Illuminate\Support\Facades\Storage;

trait FileHandle
{
    /**
     * 
     * TODO: 
     * 
     * @param mixed $file
     * @param mixed $folder
     * @return string
     */
    function upload_public($file): string
    {
        $fileName = uuid_create() . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');
        return "/uploads/" . $fileName;
    }

    private function uploadFileVideo($file, $type = "mp4"): string|bool
    {

        $path = $this->upload_public($file);
        if ($type == "mp4") {
            return $path;
        }

        if ($type == "zip") {
            return $this->handleZip($path);
        }

        return "";
    }

    // public function handleZip($path): mixed
    // {
    //     $zip         = new ZipArchive();
    //     $zipPath     = asset($path);
    //     $extractPath = '/uploads/extracted/' . uuid_create();
    //     $returnPath = 'storage/uploads/extracted/' . uuid_create();
    //     // Kiểm tra file tồn tại
    //     // if (!file_exists($zipPath)) {
    //     //     return "";
    //     // }
    //     // kiểmt ra file có phải là file zip hay không

    //     // Mở file ZIP
    //     if ($zip->open($zipPath) === true) {
    //         // Tạo thư mục để giải nén nếu chưa tồn tại
    //         if (!file_exists($extractPath)) {
    //             mkdir($extractPath, 0755, true);
    //         }

    //         // Giải nén tất cả file vào thư mục
    //         $zip->extractTo($extractPath);

    //         // Xoá file từ $path
    //         unlink($zipPath);

    //         $zip->close();
    //         return $returnPath;
    //     }
    //     else{
    //         dd(false);
    //     }
    // }
}
