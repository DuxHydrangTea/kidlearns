<?php

namespace App\Http\Controllers;

use App\Http\Traits\FileHandle;
use App\Models\DocumentSlide;
use Illuminate\Http\Request;

class DocumentSlideController extends Controller
{
    //
    use FileHandle;

    public function uploadFiles(Request $request){
        $files = $request->images;
        foreach($files as $file ){
            $filePath = 'storage' . $this->upload_public($file);
            DocumentSlide::create([
                'document_id' => $request->document_id,
                'image_path' => $filePath,
            ]);
        }
        return redirect()->back()->with('message', 'Upload ảnh slide thành công!');
    }

    public function deleteFile(Request $request){
        $id = $request->file_id;
        $file = DocumentSlide::find($id);
        $file->delete();
        return redirect()->back()->with('message', value: 'Xoá ảnh slide thành công!');
    }
}
