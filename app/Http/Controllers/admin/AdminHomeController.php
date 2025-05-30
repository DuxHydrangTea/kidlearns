<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Document;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\Subject;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AdminHomeController extends Controller
{
    //
    public function dashboard(){
        // Thống kê tổng quan
        $totalStudents = User::where('role', 'student')->count();
        $totalCourses = Course::count();
        $totalLessons = Lesson::count();
        $totalDocuments = Document::count();

        // Lấy dữ liệu hoạt động học tập trong 7 ngày gần đây
        $activityData = [];
        $activityLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $activityLabels[] = $date->format('d/m');
            
            $count = LessonProgress::whereDate('created_at', $date->format('Y-m-d'))->count();
            $activityData[] = $count;
        }

        // Thống kê theo môn học
        $subjectStats = Subject::withCount(['lessons', 'documents'])
            ->get()
            ->map(function ($subject) {
                return [
                    'name' => $subject->name,
                    'total' => $subject->lessons_count + $subject->documents_count
                ];
            });

        $subjectLabels = $subjectStats->pluck('name')->toArray();
        $subjectData = $subjectStats->pluck('total')->toArray();

        // Lấy hoạt động gần đây
        $recentActivities = LessonProgress::with(['user', 'lesson'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($progress) {
                return [
                    'created_at' => $progress->created_at,
                    'student_name' => $progress->user?->name,
                    'action' => 'Đã hoàn thành bài học',
                    'details' => $progress->lesson?->title
                ];
            });

        return view('admin.home.dashboard', compact(
            'totalStudents',
            'totalCourses',
            'totalLessons',
            'totalDocuments',
            'activityLabels',
            'activityData',
            'subjectLabels',
            'subjectData',
            'recentActivities'
        ));
    }
}
