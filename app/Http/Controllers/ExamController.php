<?php

namespace App\Http\Controllers;

use App\Models\LessonExam;
use App\Models\LessonExamHistory;
use App\Models\Set;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    //

    public function exam(Request $request)
    {
        $lessonId = $request->lesson_id;
        $difficulty = $request->difficulty;
        $set = Set::where([
            'lesson_id' => $lessonId,
            'difficulty' => $difficulty
        ])->first();

        if (!$set) {
            return redirect()->back();
        }

        $exams = $set->lessonExams;
        return view('client.exam.exam', compact('exams', 'set'));
    }

    public function submit(Request $request)
    {
        $listQuestionIds = explode(',', $request->exam_ids);
        $set_id = $request->set_id;
        $lesson_id = $request->lesson_id;
        $request = $request->except('_token', 'exam_ids', 'set_id', 'lesson_id');
        // dd($request, $listQuestionIds);

        $score = 0;
        $result = [];
        $success = [];
        foreach ($listQuestionIds as $id) {
            $question = LessonExam::find($id);

            if ($question == null) {
                continue; // Skip if question not found
            }

            if ($question->correct_answer ?? '' == $request[$id]) {
                $score += 100;
            }

            if (!isset($request[$id])) {
                $result[$id] = [
                    'question' => $question,
                    'content' => $question->content,
                    'your_answer' => '',
                    'is_correct' => false,
                ];
            } else {
                $result[$id] = [
                    'question' => $question,
                    'content' => $question->content,
                    'your_answer' => $request[$id] ?? '',
                    'is_correct' => $question->correct_answer == $request[$id] ?? '',
                ];
            }

        }

        // count correct answers in the result
        $correctCount = 0;
        foreach ($result as $item) {
            if ($item['is_correct']) {
                $correctCount++;
            }
        }

        $success['number_questions'] = count($result);
        $success['score'] = $score;
        $success['correct_count'] = $correctCount;
        $success['true_rate'] = $correctCount / count($result);

        // $request['result'] = $result;
        $history = LessonExamHistory::create([
            'user_id' => auth()->user()->id,
            'set_id' => $set_id,
            'answers' => json_encode($result),
            'lesson_id' => $lesson_id,
            'score' => $score,
            ...$success,
        ]);
        $data = compact('success', 'history', 'result');
        // dd($data);   
        return view('client.exam.result', $data);
    }
}