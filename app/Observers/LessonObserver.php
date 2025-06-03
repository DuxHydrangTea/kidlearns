<?php

namespace App\Observers;

use App\Models\Lesson;

class LessonObserver
{
    //
    use DeleteFileTrait;
    public function deleted(Lesson $lesson){
        $this->deleteFiles($lesson->getFileColumns());
    }
}
