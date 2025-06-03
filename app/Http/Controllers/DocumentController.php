<?php

namespace App\Http\Controllers;

use App\Http\Traits\FileHandle;
use App\Models\ClassModel;
use App\Models\Document;
use App\Models\DocumentFile;
use App\Models\Subject;
use Illuminate\Http\Request;
use Storage;
class DocumentController extends Controller
{
    use FileHandle;
      //
    public function index(Request $request)
    {
        $query = Document::query();
        $classes  = ClassModel::all();
        $subjects = Subject::all();
        $types = Document::getAllTypes();

        if (!is_null($request->class_id)) {
            $query->where('class_id', $request->class_id);
        }
        
        if (!is_null($request->subject_id)) {
            $query->where('subject_id', $request->subject_id);
        }

        if (!is_null($request->type)) {
            $query->where('type', $request->type);
        }

        if (!is_null($request->keyword)) {
            $query->where('title', 'like', '%' . $request->keyword . '%');
        }

        if(!is_null($request->sort)){
            $query->orderBy('created_at', $request->sort);   
        }

        if(!is_null($request->access)){
            $query->where('access', $request->access);
        }

        $documents = $query->get();
        $compact = compact('documents', 'classes', 'subjects', 'types');
        return view('client.document.index', $compact);
    }

    public function create()
    {
        $classes  = ClassModel::all();
        $subjects = Subject::all();
        return view('client.document.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $attributes = $request->except('_token');

            if ($request->hasFile('thumbnail')) {
                $attributes['thumbnail'] = 'storage' . $this->upload_public($request->thumbnail);
            }

            $documenFiles = [];
            
            // $attributes['document_file'] = json_encode($documenFiles);

            $dmt = Document::create([
                'title'       => $attributes['title'] ?? '',
                'class_id'    => $attributes['class_id'] ?? '',
                'subject_id'  => $attributes['subject_id'] ?? '',
                'user_id'     => auth()->user()->id,
                'type'        => $attributes['type'] ?? '',
                'tags'        => $attributes['tags'] ?? '',
                'thumbnail'   => $attributes['thumbnail'] ?? '',
                // 'documents'   => $attributes['document_file'] ?? '',
                'access'      => $attributes['access'] ?? '',
                'description' => $attributes['description']?? '',
            ]);

            foreach ($attributes['document_file'] as $index => $file) {
                // $documenFiles[] = [
                //     'name' => $attributes['document_name'][$index] ?? "",
                //     'file' => $this->upload_public($file),
                // ];
                DocumentFile::create([
                    'document_id' => $dmt->id,
                    'name' => $attributes['document_name'][$index] ?? "",
                    'file_path' =>  $this->upload_public($file),
                ]);
            }

            return redirect()->route('document.index')->with('message', 'Đăng tải tài liệu thành công!');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function destroy($id){
        $document = Document::findOrFail($id);
        $document->documentFiles()->each(function ($file) {
            $file->delete();
        });
        $document->delete();

        return redirect()->route('document.index')->with('message', 'Đăng tải file thành công!');
    }

    public function deleteFile($id){
        $document = DocumentFile::findOrFail($id);
        $document->delete();
        

        return redirect()->route('document.index')->with('message', 'Xoá file '.$document->file_path.' thành công!');
    }

    public function addFile(Request $request){
        $files = $request->new_files;
        if (empty($files)) {
            return redirect()->back()->with('error', 'Không có file nào được chọn!');
        }
        foreach ($files as $index => $file) {
            DocumentFile::create([
                'document_id' => $request->document_id,
                'name' => $request->name[$index] ?? "",
                'file_path' => $this->upload_public($file),
            ]);
        }
        return redirect()->route('document.index')->with('message', 'Thêm các file thành công!');
    }
}
