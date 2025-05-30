<?php

use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\FilePreviewController;
use App\Http\Controllers\admin\ClassController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\LessonTypeController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientClassController;
use App\Http\Controllers\ClientLessonTypeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonProgressController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'controller' => AuthController::class,
        'prefix' => '/auth',
    ],
    function () {
        Route::get('login', 'login')->name('auth.login');
        Route::post('login', 'handlelogin')->name('auth.handle_login');

        Route::get('register', 'register')->name('auth.register');
        Route::post('register', 'handleregister')->name('auth.handle_register');
    }
);


Route::middleware('auth_member')->group(
    function () {
        Route::group(
            [
                'controller' => HomeController::class,
            ],
            function () {
                Route::get('/', 'index')->name('home.index');
                Route::post('/user/update_profile', 'updateProfile')->name('home.update_profile');

            }
        );

        Route::group(
            [
                'controller' => QuizController::class,
                'prefix' => '/quiz',
            ],
            function () {
                Route::get('/', 'index')->name('quiz.index');
                Route::get('/create', 'create')->name('quiz.create');
                Route::post('/create', 'store')->name('quiz.handle_create');
                Route::get('/{id}', 'show')->name('quiz.show');
            }
        );

        Route::group(
            [
                'controller' => LessonController::class,
                'prefix' => '/lesson',
            ],
            function () {
                Route::get('create', 'create')->name('lession.create');
                Route::post('create', 'store')->name('lession.store');
                Route::get('/{id}', 'show')->name('lession.show');

                Route::group(
                    [
                        'prefix' => '/{lessonId}/exam',
                        'controller' => ExamController::class,
                    ],
                    function () {
                        Route::get('/', 'exam')->name('lession.exam');
                        Route::post('submit', 'submit')->name('lession.exam.submit');
                    }

                );
            }
        );

        Route::group(
            [
                'controller' => AuthController::class,
                'prefix' => '/auth',
            ],
            function () {
                Route::get('logout', 'logout')->name('auth.logout');
            }
        );

        Route::group(
            [
                'controller' => DownloadController::class,
                'prefix' => '/download',
            ],
            function () {
                Route::post('download', 'download')->name('download.download');
                Route::get('download-all', 'downloadAll')->name('download.download_all');

            }
        );

        Route::group(
            [
                'controller' => LessonProgressController::class,
                'prefix' => '/lesson-progess',
            ],
            function () {
                Route::get('increase-progress', 'increaseProgress')->name('lesson_progess.increase_progress');
            }
        );

        Route::group(
            [
                'controller' => ClientLessonTypeController::class,
                'prefix' => '/lesson-type',
            ],
            function () {
                Route::get('/', 'index')->name('lesson_type.index');
                Route::get('/get-relationships', 'getRelationships')->name('lesson_type.get_relationships');
                Route::get('/{id}', 'list')->name('lesson_type.list');


            }
        );

        Route::resource('document', DocumentController::class);

        Route::get('/file-preview', [FilePreviewController::class, 'filePreview'])->name('file_preview');

        Route::group([
            'prefix' => '/class',
            'controller' => ClientClassController::class,
        ], function () {
            Route::get('/{id}', 'index')->name('class.index');
        });
    }
);



// ADMIN


Route::group(
    [
        'prefix' => '/admin',
        'as' => 'admin.',
        'middleware' => 'auth_member',
    ],
    function () {
        Route::resource('users', UserController::class);
        Route::resource('classes', ClassController::class);
        Route::resource('classes', ClassController::class);
        Route::resource('subjects', SubjectController::class);
        // Route::resource('courses', CourseController::class);   
        Route::resource('lesson-type', LessonTypeController::class);
    }
);