@extends('client.layouts.layout', [
    'indexMenu' => 2,
])
@push('styles')
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <style>
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe,
        .video-container video,
        .video-container .plyr {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 1rem;
        }

        .difficulty-selector input[type="radio"] {
            display: none;
        }

        .difficulty-selector input[type="radio"]+label {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .difficulty-selector input[type="radio"]:checked+label {
            transform: scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .quiz-card {
            transition: all 0.3s ease;
        }

        .quiz-card:hover {
            transform: translateY(-5px);
        }

        /* Tùy chỉnh Plyr */
        .plyr--full-ui input[type=range] {
            color: #ec4899 !important;
            /* primary-500 */
        }

        .plyr__control--overlaid {
            background: rgba(236, 72, 153, 0.8) !important;
            /* primary-500 với độ trong suốt */
        }

        .plyr--video .plyr__control:hover {
            background: #ec4899 !important;
            /* primary-500 */
        }

        .plyr--video .plyr__control.plyr__tab-focus,
        .plyr__menu__container .plyr__control[role=menuitemradio][aria-checked=true]::before {
            background: #ec4899 !important;
            /* primary-500 */
        }

        .plyr__captions {
            font-family: 'Comic Neue', cursive !important;
            font-size: 20px !important;
        }

        .plyr__control.plyr__control--overlaid {
            padding: 20px;
        }

        .plyr__control.plyr__control--overlaid svg {
            width: 32px;
            height: 32px;
        }
    </style>
@endpush
@section('content')
    <!-- Course Navigation -->
    <div class="bg-white border-b border-gray-200">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-4 overflow-x-auto whitespace-nowrap">
                <a href="#" class="text-gray-600 hover:text-primary-600">
                    <i class="fas fa-home"></i>
                </a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="#" class="text-gray-600 hover:text-primary-600">{{$lesson->lessonType?->class?->name}}</a>
                <span class="mx-2 text-gray-400">/</span>
                <a href="#" class="text-gray-600 hover:text-primary-600">{{ $lesson->lessonType?->name }}</a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-primary-600 font-bold">{{$lesson->title}}</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <!-- Left Column - Video and Info -->
            <div class="lg:w-2/3">
                <div class="mb-6 ">
                    <div class="flex gap-2 mb-2">
                        <span
                            class="bg-primary-100 text-primary-800 border-2 border-primary-400 text-sm font-bold px-3 py-1 rounded-full mr-2">{{ $lesson->lessonType?->subject?->name }}</span>
                        <span
                            class="bg-purple-100 text-purple-800 border-2 border-purple-400 text-sm font-bold px-3 py-1 rounded-full mr-2">{{ $lesson->lessonType?->class?->name }}</span>

                    </div>
                    <h1 class="text-3xl font-bold text-blue-900 mb-2">Serie: {{ $lesson->lessonType?->name }}</h1>
                    <p class="text-gray-600 mb-4"> <span class="border-b-2 border-b-red-500">Giới thiệu:</span>
                        {!! nl2br($lesson->lessonType?->description) !!}</p>

                    <div class="flex items-center mb-4">
                        <img src="{{ asset($lesson->user->avatar) }}" alt="Teacher"
                            class="w-10 object-cover h-10 rounded-full mr-3 border-2 border-primary-300">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $lesson->user->name }}</h3>
                            <div class="text-sm text-gray-500">Giáo viên Toán • Cập nhật {{ $lesson->updated_at }}</div>
                        </div>
                    </div>
                </div>

                <div class="h-[3px] w-full bg-red-400 my-4 relative">
                    <img src="{{ asset('assets/images/panda.gif') }}" class="absolute right-0 bottom-0 w-[50px]"
                        alt="">
                </div>
                <!-- Lesson Title and Info -->
                <div class="mb-6">
                    <div class="flex items-center mb-2">
                        <span class="bg-primary-100 text-primary-800 text-sm font-bold px-3 py-1 rounded-full mr-2">Bài
                            {{ $lesson->order }}</span>
                        <span
                            class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full">{{ $lesson->duration }}
                            phút</span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $lesson->title }}</h2>
                    <p class="text-gray-600 mb-4">{!! nl2br($lesson->description) !!}</p>
                </div>

                <!-- Video Player -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
                    <div class="video-container">
                        @if ($lesson->isVideoMp4())
                            <video id="player" class="plyr__video-embed" poster="{{ $lesson->thumbnail }}" playsinline
                                controls
                                data-poster="https://img.freepik.com/free-vector/hand-drawn-colorful-math-background_23-2148157266.jpg">
                                <source src="{{ asset($lesson->video_path) }}" type="video/mp4" />
                                <track kind="captions" label="Tiếng Việt"
                                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                                    srclang="vi" default />
                            </video>
                        @else
                            <iframe src="{{ asset($lesson->video_path) }}/res/index.html" style="zoom: 1.5"></iframe>
                        @endif
                    </div>

                    <!-- Video Controls -->
                    <div class="p-4 border-t border-gray-100">
                        <div class="flex flex-wrap justify-between items-center">
                            <div class="flex space-x-4">
                                <button class="flex items-center text-gray-700 hover:text-primary-600">
                                    <i class="fas fa-thumbs-up mr-1"></i>
                                    <span>Thích</span>
                                </button>
                                <button class="flex items-center text-gray-700 hover:text-primary-600">
                                    <i class="fas fa-bookmark mr-1"></i>
                                    <span>Lưu</span>
                                </button>
                                <button class="flex items-center text-gray-700 hover:text-primary-600">
                                    <i class="fas fa-share-alt mr-1"></i>
                                    <span>Chia sẻ</span>
                                </button>
                            </div>
                            <div class="flex items-center mt-2 sm:mt-0">
                                <span class="text-gray-600 mr-2">Tốc độ:</span>
                                <select id="speed-selector" class="bg-gray-100 rounded-lg px-2 py-1 text-sm">
                                    <option value="0.5">0.5x</option>
                                    <option value="0.75">0.75x</option>
                                    <option value="1" selected>1x</option>
                                    <option value="1.25">1.25x</option>
                                    <option value="1.5">1.5x</option>
                                    <option value="2">2x</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lesson Description -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-8">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Nội dung bài học</h2>
                        <div class="prose max-w-none">
                            {!! nl2br($lesson->content) !!}
                            <br>
                            <br>
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Tags</h2>
                            @foreach ($lesson->tags as $tag)
                                <span
                                    class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full">#{{ $tag }}</span>
                            @endforeach
                            <br>
                            <br>
                            <h2 class="text-2xl font-bold text-primary-600 mb-3">Tài liệu bổ sung</h2>

                            @foreach ($lesson->documents as $document)
                                <div class="flex items-center p-3 bg-blue-50 rounded-xl mb-4">
                                    <i class="fas fa-file text-green-500 text-2xl mr-3"></i>
                                    <div class="flex-1">
                                        <p class="font-bold">{{ $document->resource_title }}</p>
                                        <p class="text-sm text-gray-600">{{ $document->resource_description }}</p>
                                    </div>
                                    <form action="{{ route('download.download') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="file" value="{{ $document->resource_file }}">
                                        <button class="px-3 py-1 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                                            <i class="fas fa-download mr-1"></i> Tải xuống
                                        </button>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quiz Section -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-600 to-secondary-500 p-6 text-white">
                        <h2 class="text-2xl font-bold mb-2">Kiểm tra kiến thức</h2>
                        <p>Hãy làm bài kiểm tra để xem bạn đã hiểu bài học như thế nào nhé!</p>
                    </div>

                    <!-- Difficulty Selector -->
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Chọn độ khó</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 difficulty-selector">
                            <!-- Easy -->
                            <a href="{{ route('lession.exam', [
                                'lessonId' => $lesson->id,
                                'lesson_id' => $lesson->id,
                                'difficulty' => 1,
                            ]) }}"
                                data-has-exem = "{{ $lesson->getSetByDifficulty(1) ? 'true' : 'false' }}"
                                class="block cursor-pointer hover:scale-[1.05] transition-all">
                                <label for="easy"
                                    class="block bg-green-100 border-2 border-green-200 rounded-xl p-4 text-center cursor-pointer">
                                    <div
                                        class="w-16 h-16 bg-green-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-star-half-alt text-green-500 text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-green-800 mb-1">Dễ</h4>
                                    <p class="text-sm text-green-600">10 câu hỏi đơn giản</p>
                                </label>
                            </a>

                            <!-- Medium -->
                            <a href="{{ route('lession.exam', [
                                'lessonId' => $lesson->id,
                                'lesson_id' => $lesson->id,
                                'difficulty' => 2,
                            ]) }}"
                                data-has-exem = "{{ $lesson->getSetByDifficulty(2) ? 'true' : 'false' }}"
                                class="block cursor-pointer hover:scale-[1.05] transition-all">
                                <label for="medium"
                                    class="block bg-yellow-100 border-2 border-yellow-200 rounded-xl p-4 text-center cursor-pointer">
                                    <div
                                        class="w-16 h-16 bg-yellow-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-star-half-alt text-yellow-500 text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-yellow-800 mb-1">Trung bình</h4>
                                    <p class="text-sm text-yellow-600">10 câu hỏi vừa phải</p>
                                </label>
                            </a>

                            <!-- Hard -->
                            <a href="{{ route('lession.exam', [
                                'lessonId' => $lesson->id,
                                'lesson_id' => $lesson->id,
                                'difficulty' => 3,
                            ]) }}"
                                data-has-exem = "{{ $lesson->getSetByDifficulty(3) ? 'true' : 'false' }}"
                                class="block cursor-pointer hover:scale-[1.05] transition-all">
                                <label for="hard"
                                    class="block bg-red-100 border-2 border-red-200 rounded-xl p-4 text-center cursor-pointer">
                                    <div
                                        class="w-16 h-16 bg-red-200 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <i class="fas fa-star-half-alt text-red-500 text-2xl"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-red-800 mb-1">Khó</h4>
                                    <p class="text-sm text-red-600">10 câu hỏi thách thức</p>
                                </label>
                            </a>
                        </div>
                    </div>

                    <!-- Quiz Selection -->
                    <div class="p-6 hidden">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Chọn bài kiểm tra</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Quiz 1 -->
                            <div
                                class="bg-white border-2 border-primary-100 rounded-xl overflow-hidden shadow-sm hover:shadow-md quiz-card">
                                <div class="p-4">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center cursor-pointer mr-3">
                                            <i class="fas fa-plus-minus text-primary-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">Phép cộng và trừ cơ bản</h4>
                                            <p class="text-sm text-gray-600">5 câu hỏi • 5 phút</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mb-4">Kiểm tra kiến thức về phép cộng và trừ không nhớ, không
                                        mượn trong phạm vi 100.</p>
                                    <a href="#"
                                        class="block w-full py-2 bg-primary-600 text-white text-center rounded-lg hover:bg-primary-700 transition-colors">
                                        Bắt đầu
                                    </a>
                                </div>
                            </div>

                            <!-- Quiz 2 -->
                            <div
                                class="bg-white border-2 border-primary-100 rounded-xl overflow-hidden shadow-sm hover:shadow-md quiz-card">
                                <div class="p-4">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-calculator text-primary-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">Phép cộng có nhớ</h4>
                                            <p class="text-sm text-gray-600">5 câu hỏi • 5 phút</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mb-4">Tập trung vào phép cộng có nhớ trong phạm vi 100 với các
                                        bài tập đa dạng.</p>
                                    <a href="#"
                                        class="block w-full py-2 bg-primary-600 text-white text-center rounded-lg hover:bg-primary-700 transition-colors">
                                        Bắt đầu
                                    </a>
                                </div>
                            </div>

                            <!-- Quiz 3 -->
                            <div
                                class="bg-white border-2 border-primary-100 rounded-xl overflow-hidden shadow-sm hover:shadow-md quiz-card">
                                <div class="p-4">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-minus text-primary-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">Phép trừ có mượn</h4>
                                            <p class="text-sm text-gray-600">5 câu hỏi • 5 phút</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mb-4">Tập trung vào phép trừ có mượn trong phạm vi 100 với các
                                        bài tập đa dạng.</p>
                                    <a href="#"
                                        class="block w-full py-2 bg-primary-600 text-white text-center rounded-lg hover:bg-primary-700 transition-colors">
                                        Bắt đầu
                                    </a>
                                </div>
                            </div>

                            <!-- Quiz 4 -->
                            <div
                                class="bg-white border-2 border-primary-100 rounded-xl overflow-hidden shadow-sm hover:shadow-md quiz-card">
                                <div class="p-4">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-brain text-primary-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">Bài toán tổng hợp</h4>
                                            <p class="text-sm text-gray-600">5 câu hỏi • 10 phút</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mb-4">Kết hợp cả phép cộng và phép trừ trong các bài toán thực
                                        tế đơn giản.</p>
                                    <a href="#"
                                        class="block w-full py-2 bg-primary-600 text-white text-center rounded-lg hover:bg-primary-700 transition-colors">
                                        Bắt đầu
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Course Navigation and Progress -->
            <div class="lg:w-1/3">
                <div class="sticky top-24 space-y-6">
                    <!-- Course Progress -->
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <div class="bg-primary-50 p-4 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900">Tiến độ khóa học</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-700 font-bold">Hoàn thành</span>
                                <span class="text-primary-600 font-bold" id="progess-value"
                                    data-progress="{{ $lesson->myLessonProgress?->progress ?? 0 }}">{{ $lesson->myLessonProgress?->progress ?? 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="bg-primary-600 h-4 rounded-full progress-bar transition-all duration-[2000ms]"
                                    style="width: {{ $lesson->myLessonProgress?->progress ?? 0 }}%"></div>
                            </div>
                            <div class="mt-4 text-center">
                                <p class="text-gray-600 mb-2">Bạn đã hoàn thành <span id="finished-lessons">0</span>/<span
                                        id="total-lessons">0</span> bài học</p>
                                <div class="flex justify-center space-x-1">
                                    <span class="w-3 h-3 bg-primary-600 rounded-full"></span>
                                    <span class="w-3 h-3 bg-primary-600 rounded-full"></span>
                                    <span class="w-3 h-3 bg-primary-600 rounded-full"></span>
                                    <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                    <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Lessons -->
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <div class="bg-primary-50 p-4 border-b border-gray-200 flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-900">Bài học</h3>
                            <a href="{{ route('lession.create', ['lessonTypeId' => $lesson->lessonType?->id]) }}"
                                class="inline-flex gap-2 items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">Thêm
                                bài mới</a>
                        </div>
                        <div class="p-4">
                            <ul class="space-y-3">
                                @foreach ($lessons as $index => $les)
                                    <!-- Lesson 1 - Completed -->
                                    @if ($lesson->id == $les->id)
                                        <li data-progress="{{ $les->myLessonProgress?->progress ?? 0 }}"
                                            class="lesson-item flex items-center p-3 bg-primary-50 border-2 border-primary-200 rounded-xl cursor-pointer">
                                            <div
                                                class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center mr-3">
                                                <i class="fas fa-play text-white"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h4 class="font-bold text-primary-900">Bài {{ $index + 1 }}:
                                                    {{ $les->title }}</h4>
                                                <p class="text-sm text-primary-700">20 phút • Đang học - Hoàn thành lần
                                                    cuối: {{ $les->myLessonProgress?->progress ?? 0 }}%</p>
                                            </div>
                                        </li>
                                    @else
                                        @if ($les->myLessonProgress && $les->myLessonProgress->progress >= 75)
                                            <li data-progress="{{ $les->myLessonProgress?->progress ?? 0 }}"
                                                class="lesson-item flex items-center p-3 bg-gray-50 rounded-xl cursor-pointer"
                                                role="link"
                                                onclick="window.location.href='{{ route('lession.show', $les->id) }}';"
                                                tabindex="0">
                                                <div
                                                    class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                                    <i class="fas fa-check text-primary-600"></i>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900">Bài {{ $index + 1 }}:
                                                        {{ $les->title }}</h4>
                                                    <p class="text-sm text-gray-600">{{ $les->duration }} phút • Hoàn
                                                        thành - Hoàn thành lần cuối:
                                                        {{ $les->myLessonProgress?->progress ?? 0 }}%</p>
                                                </div>
                                            </li>
                                        @elseif (!$les->myLessonProgress || $les->myLessonProgress->progress <= 75)
                                            <li data-progress="{{ $les->myLessonProgress?->progress ?? 0 }}"
                                                class="lesson-item flex items-center p-3 bg-gray-50 rounded-xl opacity-70 cursor-pointer"
                                                role="link"
                                                onclick="window.location.href='{{ route('lession.show', $les->id) }}';"
                                                tabindex="0">

                                                <div
                                                    class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 20 20">
                                                        <circle cx="9.85" cy="10" r="9"
                                                            fill="currentColor" />
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-700">Bài {{ $index + 1 }}:
                                                        {{ $les->title }}</h4>
                                                    <p class="text-sm text-gray-500">{{ $les->duration }} phút • Chưa đủ
                                                        tiến trình</p>
                                                </div>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach

                                {{--                             
                            <!-- Lesson 2 - Completed -->
                            <li class="flex items-center p-3 bg-gray-50 rounded-xl">
                                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-check text-primary-600"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-900">Bài 2: Đọc và viết số trong phạm vi 100</h4>
                                    <p class="text-sm text-gray-600">20 phút • Hoàn thành</p>
                                </div>
                            </li>
                            
                            <!-- Lesson 3 - Current -->
                            <li class="flex items-center p-3 bg-primary-50 border-2 border-primary-200 rounded-xl">
                                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-play text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-primary-900">Bài 3: Phép cộng và trừ trong phạm vi 100</h4>
                                    <p class="text-sm text-primary-700">20 phút • Đang học</p>
                                </div>
                            </li>
                            
                            <!-- Lesson 4 - Locked -->
                            <li class="flex items-center p-3 bg-gray-50 rounded-xl opacity-70">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-lock text-gray-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-700">Bài 4: Giải toán có lời văn</h4>
                                    <p class="text-sm text-gray-500">25 phút • Chưa mở khóa</p>
                                </div>
                            </li>
                            
                            <!-- Lesson 5 - Locked -->
                            <li class="flex items-center p-3 bg-gray-50 rounded-xl opacity-70">
                                <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-lock text-gray-500"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-700">Bài 5: Ôn tập tổng hợp</h4>
                                    <p class="text-sm text-gray-500">30 phút • Chưa mở khóa</p>
                                </div>
                            </li> --}}
                            </ul>
                        </div>
                    </div>

                    <!-- Achievements -->
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <div class="bg-primary-50 p-4 border-b border-gray-200">
                            <h3 class="text-xl font-bold text-gray-900">Thành tích</h3>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-3 gap-3">
                                <!-- Achievement 1 -->
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583344.png" alt="Badge"
                                            class="w-10 h-10">
                                    </div>
                                    <p class="text-xs font-bold">Siêu học tập</p>
                                </div>

                                <!-- Achievement 2 -->
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583319.png" alt="Badge"
                                            class="w-10 h-10">
                                    </div>
                                    <p class="text-xs font-bold">Nhà toán học</p>
                                </div>

                                <!-- Achievement 3 - Locked -->
                                <div class="text-center opacity-50">
                                    <div
                                        class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-lock text-gray-400 text-xl"></i>
                                    </div>
                                    <p class="text-xs font-bold text-gray-500">???</p>
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-bold">
                                    Xem tất cả thành tích
                                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="bg-accent-50 rounded-2xl p-6 border-2 border-accent-100">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-accent-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-question text-accent-600 text-xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-accent-900">Cần trợ giúp?</h3>
                        </div>
                        <p class="text-accent-700 mb-4">Nếu bạn gặp khó khăn với bài học này, hãy đặt câu hỏi hoặc liên hệ
                            với giáo viên.</p>
                        <button
                            class="w-full py-2 bg-accent-600 text-white text-center rounded-lg hover:bg-accent-700 transition-colors">
                            <i class="fas fa-comment-dots mr-2"></i> Đặt câu hỏi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo Plyr
            const player = new Plyr('#player', {
                controls: [
                    'play-large', // Nút play lớn ở giữa
                    'restart', // Nút restart
                    'play', // Nút play/pause
                    'progress', // Thanh tiến trình
                    'current-time', // Thời gian hiện tại
                    'duration', // Tổng thời lượng
                    'mute', // Nút tắt tiếng
                    'volume', // Thanh âm lượng
                    'captions', // Nút bật/tắt phụ đề
                    'settings', // Nút cài đặt
                    'pip', // Picture-in-picture
                    'airplay', // Airplay
                    'fullscreen' // Nút toàn màn hình
                ],
                i18n: {
                    restart: 'Bắt đầu lại',
                    play: 'Phát',
                    pause: 'Tạm dừng',
                    played: 'Đã phát',
                    buffered: 'Đã tải',
                    currentTime: 'Thời gian hiện tại',
                    duration: 'Thời lượng',
                    volume: 'Âm lượng',
                    mute: 'Tắt tiếng',
                    unmute: 'Bật tiếng',
                    enableCaptions: 'Bật phụ đề',
                    disableCaptions: 'Tắt phụ đề',
                    enterFullscreen: 'Toàn màn hình',
                    exitFullscreen: 'Thoát toàn màn hình',
                    frameTitle: 'Trình phát cho {title}',
                    captions: 'Phụ đề',
                    settings: 'Cài đặt',
                    speed: 'Tốc độ',
                    normal: 'Bình thường',
                    quality: 'Chất lượng',
                    loop: 'Lặp lại',
                    start: 'Bắt đầu',
                    end: 'Kết thúc',
                    all: 'Tất cả',
                    reset: 'Đặt lại',
                    disabled: 'Đã tắt',
                    advertisement: 'Quảng cáo',
                    qualityBadge: {
                        2160: '4K',
                        1440: 'HD',
                        1080: 'HD',
                        720: 'HD',
                        576: 'SD',
                        480: 'SD',
                    }
                },
                captions: {
                    active: true,
                    language: 'vi',
                    update: true
                }
            });

            // Điều chỉnh tốc độ phát
            const speedSelector = document.getElementById('speed-selector');
            if (player && speedSelector) {
                speedSelector.addEventListener('change', function() {
                    player.speed = parseFloat(this.value);
                });
            }

            // Difficulty selector
            const difficultyRadios = document.querySelectorAll('input[name="difficulty"]');

            if (difficultyRadios.length > 0) {
                difficultyRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        // In a real implementation, this would update the quiz options based on difficulty
                        console.log(`Selected difficulty: ${this.id}`);
                    });
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // với duration = 20 thì cứ 20 phút sẽ tăng 10% tiến độ rồi đưa vào timeout
            const duration =  {{ $lesson->duration ?? 20 }};
            setInterval(() => {
                const progress = parseInt(document.getElementById('progess-value').getAttribute(
                    'data-progress'), 10);
                if (progress == 100) {
                    return;
                }
                fetch(
                        '{{ route('lesson_progess.increase_progress', ['lesson_id' => $lesson->id, 'progess' => 10]) }}'
                    )
                    .then(res => res.json())
                    .then(res => {
                        console.log(res.lesson_progress.progress);
                        document.getElementById('progess-value').innerText = res.lesson_progress
                            .progress + '%';
                        document.getElementById('progess-value').setAttribute('data-progress', res
                            .lesson_progress.progress);
                        document.querySelector('.progress-bar').style.width = res.lesson_progress
                            .progress + '%';
                    })

            }, (duration/ 10) * 60 * 1000);
        })
    </script>
    <script>
        const lessonItems = document.querySelectorAll('.lesson-item');
        var totelLesson = lessonItems.length;
        var fisnedNumber = 0;
        lessonItems.forEach(e => {
            let value = parseInt(e.getAttribute('data-progress'), 10)
            if (value >= 75) {
                fisnedNumber += 1;
            }
        })

        document.getElementById('finished-lessons').innerText = fisnedNumber;
        document.getElementById('total-lessons').innerText = totelLesson;
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let toastTimer;
            const exam = document.querySelectorAll('[data-has-exem]')
            exam.forEach(e => {
                let val = e.getAttribute('data-has-exem')
                if (val == "false") {
                    e.addEventListener('click', function(event) {
                        event.preventDefault();
                        window.toastLabel.textContent =
                            "Bài học này không có bài kiểm tra cho độ khó này";
                        if (toastTimer) {
                            clearInterval(toastTimer);
                        }
                        toastOpen()
                        toastTimer = setInterval(() => {
                            toastClose()
                        }, 2000)
                    })
                }
            })
        })
    </script>
@endpush
