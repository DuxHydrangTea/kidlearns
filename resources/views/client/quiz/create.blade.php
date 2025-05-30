@extends('client.layouts.layout', [
    'indexMenu' => 3,
])
@push('styles')
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

        .question-card {
            transition: all 0.3s ease;
        }

        .question-card:hover {
            transform: translateY(-5px);
        }

        .drag-handle {
            cursor: grab;
        }

        .drag-handle:active {
            cursor: grabbing;
        }
    </style>
@endpush
@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 py-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/80 to-secondary-500/80"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-2/3 text-center md:text-left mb-6 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                        Tạo Quiz Mới
                    </h1>
                    <p class="text-lg text-white text-stroke-3">
                        Tạo các bài quiz thú vị để giúp học sinh học học học tập hiệu quả!
                    </p>
                </div>
                <div class="md:w-1/3 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3898/3898082.png" alt="Create Quiz"
                        class="w-32 h-32 floating" />
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" fill="#fff">
                <path
                    d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-8 bg-white">
        @if(session('succes'))
            <div class="container mx-auto p-4 bg-green-200  rounded-xl mb-2 border-2 border-green-900 flex items-center gap-2">
                <span>
                    <svg class="text-green-500" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><path fill="currentColor" d="M16 3C8.8 3 3 8.8 3 16s5.8 13 13 13s13-5.8 13-13c0-1.4-.188-2.794-.688-4.094L26.688 13.5c.2.8.313 1.6.313 2.5c0 6.1-4.9 11-11 11S5 22.1 5 16S9.9 5 16 5c3 0 5.694 1.194 7.594 3.094L25 6.688C22.7 4.388 19.5 3 16 3m11.28 4.28L16 18.563l-4.28-4.28l-1.44 1.437l5 5l.72.686l.72-.687l12-12l-1.44-1.44z"/></svg>
                </span>
                <span>Thêm QUIZ thành công!!!</span> 
            </div>
        @endif
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex">
            <div class="flex flex-col lg:flex-row flex-1">
                <!-- Left Column - Quiz Form -->
                <form id="create-quiz-form" action="{{route('quiz.handle_create')}}" method="POST" enctype="multipart/form-data" class="w-full lg:pr-8 mb-8 lg:mb-0">
                    <!-- Quiz Info Form -->
                    @csrf
                    <div id="quiz-information" class="bg-blue-50 rounded-2xl p-6 border-2 border-blue-100 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Thông tin Quiz
                        </h2>

                        <div class="space-y-6">
                            <div>
                                <label for="quiz-title" class="block text-lg font-bold text-gray-700 mb-2">Tên Quiz</label>
                                <input type="text" id="quiz-title" name="title"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Nhập tên quiz (VD: Thử thách tính nhẩm)" value="Thử thách tính nhẩm" />
                            </div>

                            <div>
                                <label for="quiz-description" class="block text-lg font-bold text-gray-700 mb-2">Mô
                                    tả</label>
                                <textarea required id="quiz-description" name="description" rows="3"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Mô tả ngắn về quiz">
    Quiz giúp học sinh lớp 2 luyện tập kỹ năng tính nhẩm với các phép cộng, trừ đơn giản.</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="quiz-subject" class="block text-lg font-bold text-gray-700 mb-2">Môn
                                        học</label>
                                    <select id="quiz-subject" name="subject_id" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        @foreach ($subjects as  $subject)
                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="quiz-grade" class="block text-lg font-bold text-gray-700 mb-2">Lớp</label>
                                    <select id="quiz-grade" name="class_id" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        @foreach ($classes as $class )
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="quiz-difficulty" class="block text-lg font-bold text-gray-700 mb-2">Độ
                                        khó</label>
                                    <select id="quiz-difficulty" name="level" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        <option value="1" selected>Dễ</option>
                                        <option value="2">Trung bình</option>
                                        <option value="3">Khó</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="quiz-time" class="block text-lg font-bold text-gray-700 mb-2">Thời gian làm
                                        bài (giây)</label>
                                    <input type="number" id="quiz-time" name="duration" required
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                        placeholder="Thời gian cho mỗi câu hỏi" value="15" />
                                </div>
                            </div>

                            <div>
                                <label for="quiz-image" class="block text-lg font-bold text-gray-700 mb-2">Hình ảnh đại
                                    diện</label>
                                <div class="flex items-center">
                                    <div
                                        class="w-24 h-24 bg-gray-100 rounded-xl flex items-center justify-center mr-4 overflow-hidden">
                                        <img id="quiz-image-preview"
                                            src="https://cdn-icons-png.flaticon.com/512/3898/3898082.png" alt="Quiz Image"
                                            class="w-16 h-16" />
                                    </div>
                                    <div>
                                        <label
                                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                                            <i class="fas fa-upload mr-2"></i>
                                            Tải lên hình ảnh
                                            <input type="file" id="quiz-image"  name="thumbnail" class="hidden"
                                                accept="image/*" />
                                        </label>
                                        <p class="text-sm text-gray-500 mt-1">
                                            PNG, JPG hoặc GIF (tối đa 2MB)
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Questions Section -->
                    <div class="mb-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Câu hỏi</h2>
                            <button id="add-question-btn"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700">
                                <i class="fas fa-plus mr-2"></i>
                                Thêm câu hỏi
                            </button>
                        </div>

                        <div id="questions-container" class="space-y-6">
                            

                            <!-- Question 2 -->
                            @for($n = 0; $n < 50; $n++)
                                <div class="question-card  {{$n == 0 ? '' : 'hidden'}} bg-white rounded-2xl p-6 border-2 border-gray-200 shadow-sm">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="order-question text-xl font-bold text-gray-900">Câu hỏi {{$n+1}}</h3>
                                        <div class="flex space-x-2">
                                            <button class="drag-handle p-2 text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-grip-vertical"></i>
                                            </button>
                                            <button class="p-2 text-red-500 hover:text-red-700 remove-question">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-lg font-bold text-gray-700 mb-2">Nội dung câu hỏi</label>
                                            <input type="text" required
                                                name="quiz_answer[{{$n}}][title]"
                                                class="question-input w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                placeholder="Nhập câu hỏi" value="" />
                                        </div>

                                        <div>
                                            <label class="block text-lg font-bold text-gray-700 mb-2">Hình ảnh minh họa (tùy
                                                chọn)</label>
                                            <div class="flex items-center">
                                                <div
                                                    class="w-20 h-20 bg-gray-100 rounded-xl flex items-center justify-center mr-4 overflow-hidden">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/3898/3898776.png"
                                                        id="question-image-{{$n}}"
                                                        alt="Question Image" class="w-12 h-12" />
                                                </div>
                                                <div>
                                                    <label
                                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-bold rounded-xl cursor-pointer hover:bg-blue-700">
                                                        <i class="fas fa-upload mr-2"></i>
                                                        Tải lên hình ảnh
                                                        <input type="file" class="hidden" name="quiz_answer[{{$n}}][thumbnail]" accept="image/*" required
                                                        onchange="document.getElementById('question-image-{{$n}}').src=window.URL.createObjectURL(this.files[0])"
                                                        />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-lg font-bold text-gray-700 mb-2">Các lựa chọn</label>
                                            <div class="space-y-3">
                                                <!-- Option A -->
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                                                        A
                                                    </div>
                                                    <input type="text" required
                                                        name="quiz_answer[{{$n}}][question][a]"
                                                        class="answer flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                        placeholder="Lựa chọn A" value="" />
                                                    <div class="ml-4">
                                                        <input type="radio" id="correct-2-a"  required
                                                            name="quiz_answer[{{$n}}][correct]"
                                                            value="a"
                                                            class="w-5 h-5 text-primary-600 border-gray-300 focus:ring-primary-500" />
                                                        <label for="correct-2-a" class="ml-2 text-gray-700">Đúng</label>
                                                    </div>
                                                </div>

                                                <!-- Option B -->
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                                                        B
                                                    </div>
                                                    <input type="text" required
                                                        name="quiz_answer[{{$n}}][question][b]"
                                                        class="answer flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                        placeholder="Lựa chọn B" value="" />
                                                    <div class="ml-4">
                                                        <input type="radio" id="correct-2-b" 
                                                            name="quiz_answer[{{$n}}][correct]"
                                                            value="b"
                                                            class="w-5 h-5 text-primary-600 border-gray-300 focus:ring-primary-500" />
                                                        <label for="correct-2-b" class="ml-2 text-gray-700">Đúng</label>
                                                    </div>
                                                </div>

                                                <!-- Option C -->
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                                                        C
                                                    </div>
                                                    <input type="text" required
                                                        name="quiz_answer[{{$n}}][question][c]"
                                                        class="answer flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                        placeholder="Lựa chọn C" value="" />
                                                    <div class="ml-4">
                                                        <input type="radio" id="correct-2-c"  required
                                                            name="quiz_answer[{{$n}}][correct]"
                                                            value="c"
                                                            class="w-5 h-5 text-primary-600 border-gray-300 focus:ring-primary-500"
                                                            checked />
                                                        <label for="correct-2-c" class="ml-2 text-gray-700">Đúng</label>
                                                    </div>
                                                </div>

                                                <!-- Option D -->
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                                                        D
                                                    </div>
                                                    <input type="text" required
                                                        name="quiz_answer[{{$n}}][question][d]"
                                                        class="answer flex-1 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                        placeholder="Lựa chọn D" value="" />
                                                    <div class="ml-4">
                                                        <input type="radio" id="correct-2-d"  required
                                                        name="quiz_answer[{{$n}}][correct]"
                                                        value="d"
                                                            class="w-5 h-5 text-primary-600 border-gray-300 focus:ring-primary-500" />
                                                        <label for="correct-2-d" class="ml-2 text-gray-700">Đúng</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <label class="block text-lg font-bold text-gray-700 mb-2">Giải thích (tùy
                                                chọn)</label>
                                            <textarea required
                                                name="quiz_answer[{{$n}}][explain]"
                                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                placeholder="Giải thích đáp án đúng" rows="2">12 - 5 = 7. Để tính nhanh, ta có thể tính 10 - 5 = 5, sau đó cộng thêm 2 là 7.</textarea>
                                        </div>

                                        <div>
                                            <label class="block text-lg font-bold text-gray-700 mb-2">Điểm</label>
                                            <input type="number" required
                                            name="quiz_answer[{{$n}}][score]"
                                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                placeholder="Số điểm cho câu hỏi này" value="100" />
                                        </div>
                                    </div>
                                </div>
                            @endfor
                           

                            <!-- Add Question Button (Inline) -->
                            <button id="add-question-inline-btn"
                                class="w-full py-4 border-2 border-dashed border-gray-300 rounded-xl text-gray-500 hover:text-primary-600 hover:border-primary-300 flex items-center justify-center">
                                <i class="fas fa-plus-circle mr-2 text-xl"></i>
                                <span class="font-bold">Thêm câu hỏi</span>
                            </button>
                        </div>
                    </div>

                    <!-- Save Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                        <button disabled class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300">
                            Lưu nháp
                        </button>
                        <button disabled class="px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700">
                            Xem trước
                        </button>
                        <button id="submit-quiz" class="px-6 py-3 bg-secondary-500 text-white font-bold rounded-xl hover:bg-secondary-600">
                            Xuất bản
                        </button>
                    </div>
                </div>

                <!-- Right Column - Preview and Settings -->
                <div class="lg:w-1/3">
                    <div class="sticky top-24 space-y-6">
                        <!-- Quiz Preview -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            <div class="bg-primary-50 p-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Xem trước</h3>
                            </div>
                            <div class="p-4">
                                <div class="bg-blue-50 rounded-xl p-4 border-2 border-blue-100 mb-4">
                                    <div class="flex items-center mb-2">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3898/3898082.png" alt="Quiz"
                                            class="w-10 h-10 mr-3" />
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">
                                                Thử thách tính nhẩm
                                            </h4>
                                            <div class="text-sm text-gray-500">
                                                Toán học • Lớp 2
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                                        <div>
                                            <i class="fas fa-question-circle mr-1"></i>
                                            <span>2 câu hỏi</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-clock mr-1"></i>
                                            <span>15 giây/câu</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="question-container bg-white rounded-xl border-2 border-gray-200 p-4 mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="text-sm font-bold text-gray-700">
                                            Câu hỏi 1/2
                                        </div>
                                        <div class="text-sm font-bold text-gray-700">
                                            <i class="fas fa-clock text-secondary-500 mr-1"></i>
                                            <span>00:15</span>
                                        </div>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                        <div class="bg-primary-500 h-2 rounded-full" style="width: 50%"></div>
                                    </div>

                                    <div class="mb-4">
                                        <h4 class="preview-question text-lg font-bold text-gray-900 mb-2">
                                            Tính nhẩm: 7 + 8 = ?
                                        </h4>
                                        <div class="flex justify-center mb-2">
                                            <img src="https://cdn-icons-png.flaticon.com/512/3898/3898671.png"
                                                alt="Question" class="w-16 h-16" />
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2">
                                        <div class="bg-gray-50 p-2 rounded-lg text-center font-bold preview-answer">
                                            A. 13
                                        </div>
                                        <div class="bg-gray-50 p-2 rounded-lg text-center font-bold preview-answer">
                                            B. 14
                                        </div>
                                        <div
                                            class="bg-green-50 p-2 rounded-lg text-center font-bold border-2 border-green-300 preview-answer">
                                            C. 15
                                        </div>
                                        <div class="bg-gray-50 p-2 rounded-lg text-center font-bold preview-answer">
                                            D. 16
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button
                                        class="px-4 py-2 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 text-sm">
                                        Xem trước đầy đủ
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Settings -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden not-dev">
                            <div class="bg-primary-50 p-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Cài đặt Quiz <span class="text-red-500">(Chưa phát triển)</span> </h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-4">
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked />
                                            <span class="ml-2 text-gray-700">Hiển thị đáp án đúng sau mỗi câu hỏi</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked />
                                            <span class="ml-2 text-gray-700">Hiển thị giải thích cho đáp án đúng</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked />
                                            <span class="ml-2 text-gray-700">Hiệu ứng khi trả lời đúng</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked />
                                            <span class="ml-2 text-gray-700">Hiển thị bảng xếp hạng</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked />
                                            <span class="ml-2 text-gray-700">Trao huy hiệu khi hoàn thành</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 mb-2">Điểm đạt yêu cầu (%)</label>
                                        <input type="number"
                                            class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none"
                                            value="70" />
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 mb-2">Huy hiệu khi hoàn thành</label>
                                        <div class="flex space-x-4">
                                            <div class="flex flex-col items-center">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center mb-1">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/2583/2583344.png"
                                                        alt="Badge" class="w-8 h-8" />
                                                </div>
                                                <span class="text-xs text-gray-700">Nhà toán học</span>
                                            </div>
                                            <div class="flex flex-col items-center">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-secondary-100 flex items-center justify-center mb-1">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/2583/2583319.png"
                                                        alt="Badge" class="w-8 h-8" />
                                                </div>
                                                <span class="text-xs text-gray-700">Tính nhanh</span>
                                            </div>
                                            <button
                                                class="w-12 h-12 rounded-full border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 hover:text-primary-600 hover:border-primary-300">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Statistics (For existing quizzes) -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                            <div class="bg-primary-50 p-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Thống kê</h3>
                            </div>
                            <div class="p-4 text-center text-gray-500">
                                <p>
                                    Thống kê sẽ được hiển thị sau khi quiz được xuất bản và có
                                    học sinh tham gia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // File upload preview for quiz image
            const quizImageInput = document.getElementById("quiz-image");
            const quizImagePreview = document.getElementById("quiz-image-preview");

            if (quizImageInput && quizImagePreview) {
                quizImageInput.addEventListener("change", function(e) {
                    if (e.target.files.length > 0) {
                        const file = e.target.files[0];
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            quizImagePreview.src = e.target.result;
                        };

                        reader.readAsDataURL(file);
                    }
                });
            }

            // Add question button functionality
            const addQuestionBtn = document.getElementById("add-question-btn");
            const addQuestionInlineBtn = document.getElementById(
                "add-question-inline-btn"
            );
            const questionsContainer = document.getElementById(
                "questions-container"
            );

            function addNewQuestion() {
                const questionCount =
                    document.querySelectorAll(".question-card").length + 1;
                    const nextQuestionCard = document.querySelector('.question-card.hidden');
                    if (nextQuestionCard) {
                        nextQuestionCard.classList.remove('hidden');
                    }
                else{
                    alert('Giới hạn 50 câu hỏi! ');
                }
            }

            const removeQuestionBtn = document.querySelectorAll('.remove-question');

            removeQuestionBtn.forEach(btn => {
                btn.addEventListener('click', function() {
                    const questionCard = this.closest('.question-card');
                    if (questionCard) {
                        questionCard.classList.add('hidden');
                        updateLabelOrderQuestion();
                    }
                });
            })

            function updateLabelOrderQuestion(){
                // element has question-card and not has class hidden
                const questionCards = document.querySelectorAll('.question-card:not(.hidden)');
                questionCards.forEach((card, index) => {
                    const questionLabel = card.querySelector('.order-question');
                    questionLabel.textContent = `Câu hỏi ${index + 1}`;
                })
            }

            if (addQuestionBtn) {
                addQuestionBtn.addEventListener("click", addNewQuestion);
            }

            if (addQuestionInlineBtn) {
                addQuestionInlineBtn.addEventListener("click", addNewQuestion);
            }

            // Setup delete buttons for questions
            
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questionsContainer = document.getElementById('questions-container');
            
            // Khởi tạo Sortable
            new Sortable(questionsContainer, {
                animation: 150, // Thời gian animation khi kéo thả (ms)
                handle: '.drag-handle', // Chỉ cho phép kéo thả bằng nút có class drag-handle
                ghostClass: 'bg-gray-100', // Class cho phần tử đang được kéo
                
                // Sự kiện khi kéo thả hoàn tất
                onEnd: function(evt) {
                    // Cập nhật số thứ tự các câu hỏi
                    const questions = questionsContainer.querySelectorAll('.question-card');
                    questions.forEach((question, index) => {
                        // Cập nhật tiêu đề câu hỏi
                        const questionTitle = question.querySelector('h3');
                        questionTitle.textContent = `Câu hỏi ${index + 1}`;
                        
                        // Cập nhật ID và name của các radio button
                        const radioButtons = question.querySelectorAll('input[type="radio"]');
                        const radioLabels = question.querySelectorAll('label[for^="correct-"]');
                        
                        radioButtons.forEach((radio, optionIndex) => {
                            const oldId = radio.id;
                            const newId = `correct-${index + 1}-${String.fromCharCode(97 + optionIndex)}`; // a, b, c, d
                            radio.id = newId;
                            radio.name = `correct-${index + 1}`;
                            
                            // Cập nhật for của label tương ứng
                            const label = radioLabels[optionIndex];
                            if (label) {
                                label.setAttribute('for', newId);
                            }
                        });
                    });
                }
            });
        });
    </script>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questionCards = document.querySelectorAll('.question-card');
        const previewQuestion = document.querySelector('.question-container');
        let currentCard = null;
    
        function updatePreview(card) {
            if (!card) return;
            
            // Xóa border highlight của các card khác
            questionCards.forEach(c => c.classList.remove('border-primary-500'));
            // Thêm border highlight cho card được chọn
            card.classList.add('border-primary-500');
            
            // Lấy thông tin từ card được chọn
            const questionNumber = card.querySelector('h3').textContent.split(' ')[2];
            const questionInput = card.querySelector('input.question-input');
            const questionImage = card.querySelector('img').src;
            
            // Cập nhật số câu hỏi trong preview
            const previewQuestionNumber = previewQuestion.querySelector('.text-sm.font-bold.text-gray-700');
            previewQuestionNumber.textContent = `Câu hỏi ${questionNumber}/2`;
            
            // Cập nhật nội dung câu hỏi
            // const questionInput = document.querySelector('input.question-input');
            const previewQuestionText = previewQuestion.querySelector('h4.preview-question');
            
            const oldInput = document.querySelector('input.question-input');
            if (oldInput) {
                oldInput.removeEventListener('input', updateQuestionText);
            }
            
            previewQuestionText.textContent = questionInput.value;
            // Thêm event listener mới
            function updateQuestionText() {
                previewQuestionText.textContent = questionInput.value;
            }
            questionInput.addEventListener('input', updateQuestionText);
            
            // Cập nhật hình ảnh
            const previewQuestionImage = previewQuestion.querySelector('img');
            previewQuestionImage.src = questionImage;
            
            // Lấy tất cả input có class answer trong card hiện tại
            const answerInputs = card.querySelectorAll('input.answer');
            // Lấy tất cả element có class preview-answer
            const previewAnswers = previewQuestion.querySelectorAll('.preview-answer');
            
            
            // Cập nhật nội dung và style cho từng đáp án
            answerInputs.forEach((input, index) => {
                if (index < 4) {
                    const isCorrect = input.parentElement.querySelector('input[type="radio"]').checked;
                    const previewAnswer = previewAnswers[index];
                    
                    // Cập nhật nội dung
                    previewAnswer.textContent = `${String.fromCharCode(65 + index)}. ${input.value}`;
                    
                    // Cập nhật style
                    previewAnswer.className = isCorrect 
                        ? 'bg-green-50 p-2 rounded-lg text-center font-bold border-2 border-green-300 preview-answer'
                        : 'bg-gray-50 p-2 rounded-lg text-center font-bold preview-answer';
                }
            });
        }
        document.addEventListener('click', function(e) {
            const card = e.target.closest('.question-card');
            if (card) {
                currentCard = card;
                updatePreview(card);
            }
        });
        // Xử lý sự kiện click vào question card
        questionCards.forEach(card => {
            card.addEventListener('click', function() {
                currentCard = this;
                updatePreview(currentCard);
            });
    
            // Thêm event listener cho các radio button trong card
            const radioButtons = card.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    updatePreview(card);
                });
            });
    
            // Thêm event listener cho các input answer trong card
            const answerInputs = card.querySelectorAll('input.answer');
            answerInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (currentCard === card) {
                        updatePreview(card);
                    }
                });
            });
        });
    });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // select all input and textarea in quiz-information
        
            document.getElementById('create-quiz-form').querySelectorAll('button').forEach(function(button) {
                button.setAttribute('type', 'button')
            });
            document.getElementById('submit-quiz').addEventListener('click', function(e) {
                e.preventDefault();
                const questionsContainer = document.getElementById('questions-container');
                questionsContainer.querySelectorAll('.question-card').forEach(function(card) {
                    if(card.classList.contains('hidden')){
                        card.querySelectorAll('input, textarea').forEach(function(input) {
                            input.disabled = true;
                        });
                    }
                });
                document.getElementById('create-quiz-form').submit();
            })
        })
    </script>
@endpush
</html>
