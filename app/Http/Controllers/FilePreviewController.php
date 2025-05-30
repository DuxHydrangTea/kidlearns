<?php

namespace App\Http\Controllers;
use Vish4395\LaravelFileViewer\LaravelFileViewer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FilePreviewController extends Controller
{
    //
    public function filePreview(Request $request){
        $fileName = $request->fileName;
        $filePath = $fileName;
        $disk = 'public';
        $fileUrl = asset(   'storage' . $fileName);
        $fileData = [
            [
                'label' => __('Label'),
                'value' => "Value"
            ]
        ];
        return LaravelFileViewer::show($fileName, $filePath, $fileUrl, $disk, $fileData);
    }
}
