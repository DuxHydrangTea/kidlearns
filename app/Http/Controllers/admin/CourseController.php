<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('admin.course.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.course.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $course = Course::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được tạo thành công');
    }

    public function edit(string $id)
    {
        $course = Course::find($id);
        return view('admin.course.edit', compact('course'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $course = Course::find($id);
        
        $course->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được cập nhật thành công');
    }

    public function destroy(string $id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Khóa học đã được xóa thành công');
    }
}
