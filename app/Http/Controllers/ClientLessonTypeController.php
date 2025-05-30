<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\LessonType;
use App\Models\Subject;

class ClientLessonTypeController extends Controller
{
    //

    public function index(Request $request)
    {
        $query = LessonType::query();


        if ( !is_null($request->class_id) &&  $request->has('class_id')) {
            $query->where('class_id', $request->input('class_id'));
        }
        if (!is_null($request->subject_id) && $request->has('subject_id')) {
            $query->where('subject_id', $request->input('subject_id'));
        }
        
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $lessonTypes = $query->get();
        return view('client.lesson_type.index', compact(
            'lessonTypes',
            'classes',
            'subjects',
        ));
    }

    public function list($id){
        $lessonTypes = LessonType::findOrFail($id);
        $lesson = Lesson::where('lesson_type_id', $id)->orderBy('order')->first();
        if($lesson){
            return redirect()->route('lession.show', $lesson->id);
        }
        return redirect()->back();
    }

    public function getRelationships(Request $request){
        $lesson_type_id = $request->input('lesson_type_id');
        $lessonType = LessonType::findOrFail($lesson_type_id);
        $class_id = $lessonType->class?->id ?? 0;
        $subject_id = $lessonType->subject?->id?? 0;

        return [
            'class_id' => $class_id,
            'subject_id' => $subject_id,
        ];
    }
}
