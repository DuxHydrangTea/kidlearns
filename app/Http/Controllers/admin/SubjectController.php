<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Http\Traits\FileHandle;
class SubjectController extends Controller
{
    use FileHandle;
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);



        $subject = Subject::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.subjects.index')->with('success', 'Môn học đã được tạo thành công');
    }

    public function edit(string $id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.edit', compact('subject'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $subject = Subject::find($id);

        if($request->hasFile('thumbnail')){
            $thumbnail = 'storage' . $this->upload_public($request->file('thumbnail'));
        }
        $subject->update([
            'name' => $request->name,
            'description' => $request->description,
            'thumbnail' => $thumbnail ?? $subject->thumbnail,
        ]);
        return redirect()->route('admin.subjects.index')->with('success', 'Môn học đã được cập nhật thành công');
    }

    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Môn học đã được xóa thành công');
    }
}
