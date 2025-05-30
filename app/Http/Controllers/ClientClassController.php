<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClientClassController extends Controller
{
    //
    public function index($id){
        $class = ClassModel::find($id);
        $subjects = Subject::all();
        return view('client.class.index', compact('class', 'subjects'));
    }
}
