<?php

namespace App\Http\Controllers;
use App\Models\LessonExam;
use App\Models\LessonExamHistory;
use App\Models\LessonProgress;
use Vish4395\LaravelFileViewer\LaravelFileViewer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class HistoryController extends Controller
{
    //

    public function myHistory(){
        // oder by created_at desc
        $user = auth()->user();
        $lessonProgresses =  LessonProgress::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $exams = LessonExamHistory::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('client.history.my_history', compact('lessonProgresses', 'exams'));
    }

    public function otherHistory(Request $request){
        $users = User::where('role', 1)->get();
        $lessonProgresses =  LessonProgress::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->get();
        $exams = LessonExamHistory::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->get();
        return view('client.history.other_history', compact('users','lessonProgresses', 'exams'));
    }
}
