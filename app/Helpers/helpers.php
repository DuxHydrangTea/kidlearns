<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

const UPLOAD_PATH = "/uploads/";

if (!function_exists('handleZip')) {
    function handleZip($path): mixed
    {
        $zip = new ZipArchive();
        $zipPath = Storage::path($path);
        $extractPath = Storage::path('/uploads/extracted/' . uuid_create());

        // Kiểm tra file tồn tại
        if (!file_exists($zipPath)) {
            return false;
        }

        // Mở file ZIP
        if ($zip->open($zipPath) === true) {
            // Tạo thư mục để giải nén nếu chưa tồn tại
            if (!file_exists($extractPath)) {
                mkdir($extractPath, 0755, true);
            }
            $zip->extractTo($extractPath);
            $zip->close();

            return $extractPath;
        }

        return false;
    }
}
if (!function_exists('upload_public')) {
    function upload_public($file, $folder = "")
    {
        $fileName = $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName, 'public');
        return UPLOAD_PATH . $folder . $fileName;
    }
}

if(!function_exists('uploadPath')){
    function uploadPath($file)
    {
       return Storage::path($file);
    }
}

if(!function_exists('myDD')){
    function myDD($file)
    {
        dd($file);
    }
}