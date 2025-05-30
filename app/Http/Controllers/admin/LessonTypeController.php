<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\LessonType;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Traits\FileHandle;

class LessonTypeController extends Controller
{
    use FileHandle;
    //
    public function index(){
        $lessonTypes = LessonType::all();
        return view('admin.lesson-type.index', compact('lessonTypes'));
    }

    public function create(){
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $courses = Course::all();
        return view('admin.lesson-type.create', compact('classes', 'subjects', 'courses'));
    }

    public function store(Request $request){
        
        $lessonType = LessonType::create([
            'name' => $request->name,
            'description' => $request->description,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'course_id' => $request->course_id,
            'user_id' => auth()->user()->id,
            'thumbnail' => 'storage' . $this->upload_public($request->file('thumbnail')),

        ]);
        return redirect()->route('admin.lesson-type.index');
    }

    public function edit($id){
        $lessonType = LessonType::find($id);
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $courses = Course::all();
        return view('admin.lesson-type.edit', compact('lessonType', 'classes', 'subjects', 'courses'));
    }

    public function update(Request $request, $id){
        $lessonType = LessonType::find($id);

        $attr = [
            'name' => $request->name,
            'description' => $request->description,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'course_id' => $request->course_id,
            'user_id' => auth()->user()->id,
        ];
        if($request->file('thumbnail')){
            $attr['thumbnail'] = 'storage'. $this->upload_public($request->file('thumbnail'));
        }
        $lessonType->update($attr);
        return redirect()->route('admin.lesson-type.index');
    }

    public function destroy($id){
        
    }
}
