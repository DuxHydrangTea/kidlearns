<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class DownloadController extends Controller
{
    //
    public function download(Request $request){
        $file = Storage::path($request->file);
        return response()->download($file);
    }

}
