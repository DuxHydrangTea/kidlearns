<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lesson;
use App\Models\LessonProgress;
class LessonProgressController extends Controller
{
    //
    public function increaseProgress(Request $request){
        $process = (int)$request->progress ?? 10;
        $user = auth()->user();
        $lessonProgress = LessonProgress::where('lesson_id', $request->lesson_id)->where('user_id', $user->id)->first();
        if(!$lessonProgress){
            $lessonProgress = new LessonProgress();
            $lessonProgress->lesson_id = $request->lesson_id;
            $lessonProgress->user_id = $user->id;
            $lessonProgress->progress = 0;
            $lessonProgress->save();    
        }
        $lessonProgress->progress = max(1, min(100, $lessonProgress->progress + 10));
        $lessonProgress->save();
        
        if($lessonProgress->progress == 100){
            return response()->json([
                'status' => 'success',
                'message' => 'You have already completed this lesson',
                'lesson_progress' => $lessonProgress,
            ]);
        }
        else{
            return response()->json([
                'status' =>'success',
                'message' => 'You have completed '.$lessonProgress->progress.'% of this lesson',
                'lesson_progress' => $lessonProgress,
             ]);
        }
    }
}
