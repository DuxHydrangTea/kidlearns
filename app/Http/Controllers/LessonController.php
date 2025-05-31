<?php

namespace App\Http\Controllers;

use App\Http\Traits\FileHandle;
use App\Models\ClassModel;
use App\Models\Lesson;
use App\Models\Sets;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;
use App\Models\LessonExam;
use App\Models\LessonType;
use App\Models\Set;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    use FileHandle;
    //
    public function create(Request $request)
    {
        // courses 
        // lessons
        // subjects
        $courses = Course::all();
        $classes = ClassModel::all();
        $subjects = Subject::all();
        $lessonTypes = LessonType::all();
        if ($request->has('lesson_type_id')) {
            $lessonType = LessonType::find($request->lesson_type_id);
        } else {
            $lessonType = null;
        }
        return view('client.lesson.create', compact('lessonTypes', 'courses', 'classes', 'subjects', 'lessonType'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // ===== LESSION

        $attributesLession = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => auth()->user()->id,
                'lesson_type_id' => $request->lesson_type_id,
                'order' => $max_order ?? 0,
                'duration' => $request->duration,
                'level' => $request->level ?? 1,
                'thumbnail' => $request->hasFile('thumbnail') ? 'storage' . $this->upload_public($request->file('thumbnail')) : "",
                'tags' => $request->tags,
                'objectives' => $request->objectives,
                'content' => $request->content,
                'video_title' => $request->video_title,
                'zip_title' => $request->zip_title,
                'images_title' => $request->images_title,
            ];


        try {
            DB::beginTransaction();

            if ($request->hasFile('video_path')) {
                $videoPath = 'storage' . $this->upload_public($request->file('video_path'));
                $attributesLession['video_path'] = $videoPath;
            }

            if($request->hasFile('zip_path')){
                $zipPath = $this->upload_public($request->file('zip_path'));
                $extractZipPath = $this->handleZipVideo($zipPath);
                $attributesLession['zip_path'] = $extractZipPath;
            }

            if($imageFiles = $request->file('image_paths')){
                $imagePaths = [];
                foreach ($imageFiles as $imageFile) {
                    $imagePaths[] = 'storage' . $this->upload_public($imageFile);
                }
                $uploadImagesPath = json_encode($imagePaths);
                $attributesLession['image_paths'] = $uploadImagesPath;
            }


            if (!is_null($request->lesson_type_id))
                $max_order = Lesson::where('lesson_type_id', $request->lesson_type_id)->max('order') + 1 ?? 0;

            

            // documents attribute
            $documents = [];
            foreach (($request->resource_file ?? []) as $index => $value) {
                if ($value) {
                    $documents[] = [
                        'resource_title' => $request->resource_title[$index] ?? '',
                        'resource_type' => $request->resource_type[$index] ?? '',
                        'resource_description' => $request->resource_description[$index] ?? '',
                        'resource_file' => $request->file('resource_file')[$index] ? $this->upload_public($request->file('resource_file')[$index]) : "",
                    ];
                }
            }
            $attributesLession['documents'] = json_encode($documents);
            $lession = Lesson::create($attributesLession);

            // ===== SET
            $setTitles = $request->set_title;
            $setDescriptions = $request->set_description;
            $setDifficulties = $request->set_difficulty;
            $set = [];

            for ($setIndex = 1; $setIndex <= 3; $setIndex++) {
                // create a new set 
                $set = Set::create([
                    'title' => $setTitles[$setIndex],
                    'lesson_id' => $lession->id,
                    'description' => $setDescriptions[$setIndex],
                    'difficulty' => $setDifficulties[$setIndex],
                ]);

                //create question for set
                foreach ($request->set_quesion[$setIndex] as $questionIndex => $question) {
                    $question = LessonExam::create([
                        'set_id' => $set->id,
                        'lesson_id' => $lession->id,
                        'content' => $request->set_quesion[$setIndex][$questionIndex],
                        'answers' => json_encode($request->set_answer[$setIndex][$questionIndex]),
                        'correct_answer' => $request->set_answer_true[$setIndex][$questionIndex],
                        'explanation' => $request->set_explain_answer[$setIndex][$questionIndex],
                    ]);
                }

            }
            DB::commit();
            return redirect()->route('home.index')->with('message', 'Tạo bài học thành công');

        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
        }
    }
    public function show($id)
    {
        $lesson = Lesson::find($id);

        $lessons = $lesson->lessonType->lessons;

        if ($lesson) {
            return view('client.lesson.show', compact('lesson', 'lessons'));
        }
        return redirect()->route('home.index');
    }


    public function handleZipVideo($path): mixed
    {
        $zip = new ZipArchive();
        $zipPath = Storage::path($path);
        $uuid = random_int(1, 100000);
        $extractPath = storage_path('app/public/uploads/extracted/' . $uuid);
        $returnPath = 'storage/uploads/extracted/' . $uuid;

        if (!file_exists($zipPath)) {
            return "";
        }

        if ($zip->open($zipPath) === true) {

            if (!file_exists($extractPath)) {
                mkdir($extractPath, 0755, true);
            }
            $zip->extractTo($extractPath);

            // unlink($zipPath);

            $zip->close();
            return $returnPath;
        }
        return "";
    }
}