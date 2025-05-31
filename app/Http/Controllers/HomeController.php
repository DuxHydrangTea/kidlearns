<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonExam;
use App\Models\LessonExamHistory;
use App\Models\LessonType;
use Illuminate\Http\Request;
use App\Http\Traits\FileHandle;
class HomeController extends Controller
{
    //
    use FileHandle;

    public function index()
    {
        $finishedLesson = auth()->user()->lessonProgresses()
            ->where('progress', '100')
            ->count();

            // tính toán số ngày học liên tiếp dự trên field created_at của lesson_progress
        $lastProgress = auth()->user()->lessonProgresses()
            ->where('progress', '100')
            ->orderBy('created_at', 'desc')
            ->first();
        $currentDate = now();
        $lastDate = $lastProgress ? $lastProgress->created_at : null;
        $daysStudied = 0;
        if ($lastDate) {
            $daysStudied = $currentDate->diffInDays($lastDate);
        }


        $examsFinished = LessonExamHistory::where('user_id', auth()->id());

        $total_count = $examsFinished->count();
        $total_score = $examsFinished->sum('score');

        $lessons = Lesson::take(3)->get();
        $lessonTypes = LessonType::take(3)->get();
        return view('client.home.index', 
        compact('lessons', 'lessonTypes', 'finishedLesson', 'total_count', 'total_score', 'daysStudied'));
    }

    public function updateProfile(Request $request){

        $user = auth()->user();

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $avatarName = 'storage' . $this->upload_public($avatar);
            $user = auth()->user();
            $user->avatar = $avatarName;
            $user->save();
        }

        $user->update($request->except('avatar'));

        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
}