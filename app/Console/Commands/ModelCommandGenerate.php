<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModelCommandGenerate extends Command
{
    protected $signature = 'make:all-models';
    protected $description = 'Generate all models for EduKids project';

    // Danh sách các model cần tạo (kèm tùy chọn -m để tạo migration)
    protected $models = [
        'Lesson' => ['-m'],
        'LessonExam' => ['-m'],
        'ClassModel' => ['-m', '--table=classes'], // Lưu ý tên table
        'Subject' => ['-m'],
        'Course' => ['-m'],
        'Document' => ['-m'],
        'Quiz' => ['-m'],
        'QuizQuestion' => ['-m'],
        'User' => ['-m'],
        'Member' => ['-m'],
    ];

    public function handle()
    {
        foreach ($this->models as $model => $options) {
            $this->call('make:model', [
                'name' => $model,
                ...$options
            ]);
            $this->info("✅ Model {$model} created successfully!");
        }

        $this->newLine();
        $this->info('🎉 All models & migrations generated!');
    }
}