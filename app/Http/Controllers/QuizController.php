<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\LessonExam;
use App\Models\LessonType;
use App\Models\Set;
use App\Models\Subject;
use App\Models\ClassModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\FileHandle;
use App\Models\QuizQuestion;

class QuizController extends Controller
{
    use FileHandle;
    //

    public function index(Request $request){
        $quizzes = Quiz::all();
        $subjects = Subject::all();
        $classes = ClassModel::all();

        if(!is_null($request->class_id)){
            $quizzes = $quizzes->where('class_id', $request->class_id);
        }

        if(!is_null($request->subject_id)){
            $quizzes = $quizzes->where('subject_id', $request->subject_id);
        }

        if(!is_null($request->level)){
            $quizzes = $quizzes->where('level', $request->level);
        }

        return view('client.quiz.index', compact('quizzes', 'subjects', 'classes'));
    }
    public function create()
    {
        $courses  = Course::all();
        $classes  = ClassModel::all();
        $subjects = Subject::all();
        $lessonTypes = LessonType::all();
        return view('client.quiz.create', compact('courses', 'classes', 'subjects', 'lessonTypes'));
    }

    public function store(Request $request){
        $newRequest = $request->all();
        $newRequest['user_id'] = auth()->user()->id;
        if($request->hasFile('thumbnail')){
             $newRequest['thumbnail'] = $this->upload_public($newRequest['thumbnail']);
        }
        $quiz = Quiz::create($newRequest);

        foreach ($newRequest['quiz_answer'] as $index =>  $question) {
            if(isset(
                $question['title'],
                $question['question']['a'],
                $question['question']['b'],
                $question['question']['c'],
                $question['question']['d'],
            )){
                if(isset($question['thumbnail'])){
                    $question['thumbnail'] = 'storage' . $this->upload_public($question['thumbnail']) ?? '';
                }
                $quizQuestion = QuizQuestion::create([
                    'quiz_id' => $quiz->id,
                    'title' => $question['title'],
                    // 'thumbnail' => $question['thumbnail'],
                    'order' => $index,
                    'answers' => json_encode($question['question']),
                    'correct_answer' => $question['correct'],
                    'explanation' => $question['explain'],
                    'score' => $question['score'],
                ]);
            }
            
        }
        return redirect()->back()->with('succes', true);
    }

    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quizQuestions = $quiz->quizQuestions;
        return view('client.quiz.show', compact('quiz', 'quizQuestions'));
    }
}