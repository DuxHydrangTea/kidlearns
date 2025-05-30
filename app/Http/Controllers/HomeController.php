<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonType;
use Illuminate\Http\Request;
use App\Http\Traits\FileHandle;
class HomeController extends Controller
{
    //
    use FileHandle;

    public function index()
    {
        $lessons = Lesson::take(3)->get();
        $lessonTypes = LessonType::take(3)->get();
        return view('client.home.index', compact('lessons', 'lessonTypes'));
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