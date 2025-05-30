@extends('client.layouts.layout')
@push('styles')
    <style>
        .option:active {
            transform: scale(0.98);
        }

        .question-slide {
            transition: transform 0 .5s ease-in-out;
        }
    </style>
@endpush
@section('content')
    <div class="my-5">
        <!-- Header -->
        <header class="container mx-auto px-4 mb-8 text-center">
            <div class="flex items-center justify-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/2172/2172858.png" alt="Logo" class="h-16 mr-3">
                <h1 class="text-4xl font-bold text-indigo-600">Edu<span class="text-yellow-400">Kids</span></h1>
            </div>
            <div class="bg-white rounded-xl p-4 inline-block">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600">Câu hỏi</p>
                        <p class="text-xl font-bold"><span id="current-question" class="text-indigo-600">1</span> / <span
                                id="total-questions">10</span></p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content - Slider Container -->
        <main class="container mx-auto  max-w-3xl overflow-hidden relative">
            <!-- Questions Slider -->
            <form
                action="{{ route('lession.exam.submit', [
                    'lessonId' => request()->lesson_id,
                ]) }}"
                method="POST" id="questions-slider" class="flex question-slide">
                <input type="text" hidden name="exam_ids" value="{{ $exams->pluck('id')->implode(',') }}">
                <input type="text" hidden name="lesson_id"
                    value="{{ request()->lesson_id }}">
                <input type="text" hidden name="set_id" value="{{$set->id}}">
                <!-- Question 1 -->
                @csrf
                @foreach ($exams as $exam)
                    <div class="w-full flex-shrink-0 question-slide-item">
                        <div class="bg-white rounded-2xl  overflow-hidden mb-8">
                            <div class="bg-gradient-to-r from-cyan-400 to-blue-500 p-6">
                                <img src="https://cdn-icons-png.flaticon.com/512/3281/3281289.png" alt="Hình minh họa"
                                    class="h-40 mx-auto">
                            </div>
                            <div class="p-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ $exam->content }}</h2>
                                @php
                                    $answers = $exam->answers;

                                @endphp
                                <div class="space-y-4">
                                    @foreach ($answers as $key => $answer)
                                        <label
                                            class="answer-item option w-full bg-yellow-100   border-2 border-yellow-300 rounded-xl p-4 text-left flex items-center transition-all duration-200">
                                            <input type="radio" name="{{ $exam->id }}" value="{{ $key }}"
                                                id="" hidden class="answer-item-picker">
                                            <span
                                                class="bg-white text-yellow-500 font-bold rounded-full h-8 w-8 flex items-center justify-center mr-3 uppercase">{{ $key }}</span>
                                            <span class="text-lg"> {{ $answer }}</span>
                                        </label>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </form>

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-6">
                <button id="prev-btn" type="button"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-full flex items-center disabled:opacity-50"
                    disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Câu trước
                </button>

                <div class="flex items-center">
                    <span class="text-gray-600 mr-2">Thời gian:</span>
                    <span class="text-xl font-bold text-indigo-600">Không giới hạn</span>
                </div>

                <button id="next-btn" type="button"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full flex items-center">
                    Câu tiếp
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <button id="submit-btn" type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-full flex hidden items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Hoàn thành

                </button>
            </div>
        </main>

        <!-- Progress Indicator -->
        <div class="fixed bottom-0 left-0 right-0 bg-white ">
            <div class="container mx-auto px-4 py-3">
                <div class="flex items-center">
                    <div class="w-full bg-gray-200 rounded-full h-4 mr-4">
                        <div id="progress-bar"
                            class="bg-gradient-to-r from-green-400 to-blue-500 h-4 rounded-full transition-all duration-500"
                            style="width: 10%"></div>
                    </div>
                    <button
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap">
                        Nộp bài
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Slider Logic
        const slider = document.getElementById('questions-slider');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        const currentQuestionEl = document.getElementById('current-question');
        const progressBar = document.getElementById('progress-bar');
        const totalQuestions = document.querySelectorAll('.question-slide-item').length; // Số câu hỏi
        const progressPerQuestion = 100 / totalQuestions; // Tiến trình cho mỗi câu hỏi
        let currentQuestion = 0;

        function updateUI() {
            // Cập nhật vị trí slider
            slider.style.transform = `translateX(-${currentQuestion * 100}%)`;

            // Cập nhật số câu hỏi hiện tại
            currentQuestionEl.textContent = currentQuestion + 1;

            // Cập nhật progress bar
            progressBar.style.width = `${(currentQuestion + 1) * progressPerQuestion}%`;

            // Cập nhật trạng thái nút
            prevBtn.disabled = currentQuestion === 0;

            const isLastQuestion = currentQuestion === totalQuestions - 1;
            nextBtn.disabled = isLastQuestion;
            isLastQuestion ? nextBtn.classList.add('hidden') : nextBtn.classList.remove('hidden');
            isLastQuestion ? (submitBtn.classList.remove('hidden')) : submitBtn.classList.add('hidden');

        }

        prevBtn.addEventListener('click', () => {
            if (currentQuestion > 0) {
                currentQuestion--;
                updateUI();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentQuestion < totalQuestions - 1) {
                currentQuestion++;
                updateUI();
            }
        });

        submitBtn.addEventListener('click', () => {
            slider.submit();
        })

        // Khởi tạo
        updateUI();
    </script>

    <script>
        const answerItemPickers = document.querySelectorAll('.answer-item-picker');
        answerItemPickers.forEach(picker => {
            picker.addEventListener('click', () => {
                updateAnswerPicker();
            });
        })

        const updateAnswerPicker = () => {
            answerItemPickers.forEach(picker => {
                if (picker.checked) {
                    picker.closest('label').classList.add('bg-blue-200', 'border-blue-400');
                } else {
                    picker.closest('label').classList.remove('bg-blue-200', 'border-blue-400');
                }
            })
        }
    </script>
@endpush
