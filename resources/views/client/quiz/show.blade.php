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

        .bounce {
            animation: bounce 1s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .spin-slow {
            animation: spin 15s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .option-card {
            transition: all 0.3s ease;
        }

        .option-card:hover {
            transform: translateY(-5px);
        }

        .correct-answer {
            animation: correct 0.5s ease;
        }

        @keyframes correct {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .wrong-answer {
            animation: wrong 0.5s ease;
        }

        @keyframes wrong {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-5px);
            }

            40%,
            80% {
                transform: translateX(5px);
            }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            opacity: 0;
        }

        .timer-animation {
            transition: width 1s linear;
        }

        .quiz-bg {
            background-image: url("https://img.freepik.com/free-vector/hand-drawn-colorful-science-education-wallpaper_23-2148489183.jpg");
            background-size: cover;
            background-position: center;
        }
    </style>
@endpush
@section('content')
    <!-- Quiz Header -->
    <section class="quiz-bg py-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/80 to-secondary-500/80"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-2/3 text-center md:text-left mb-6 md:mb-0">
                    <div class="flex items-center mb-2 justify-center md:justify-start">
                        <span class="bg-white text-primary-800 text-sm font-bold px-3 py-1 rounded-full mr-2">Toán học</span>
                        <span class="bg-white text-blue-800 text-sm font-bold px-3 py-1 rounded-full">Lớp 2</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                        Thử thách tính nhẩm
                    </h1>
                    <p class="text-lg text-white text-stroke-3">
                        Hãy trả lời các câu hỏi toán học để nhận điểm và huy hiệu!
                    </p>
                </div>  
                <div class="md:w-1/3 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3898/3898082.png" alt="Math Quiz"
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

    <!-- Quiz Content -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quiz Progress -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <div class="text-lg font-bold text-gray-700">Câu hỏi <span id="order-question"> 1</span>/{{count($quizQuestions)}}</div>
                    <div class="text-lg font-bold text-gray-700">
                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                        <span id="score">0</span> điểm
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-primary-500 h-4 rounded-full" style="width: 30%"></div>
                </div>
            </div>

            <!-- Timer -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <div class="text-lg font-bold text-gray-700">Thời gian còn lại</div>
                    <div class="text-lg font-bold text-gray-700" id="timer">00:15</div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div id="timer-bar" class="bg-secondary-500 h-4 rounded-full timer-animation" style="width: 100%"></div>
                </div>
            </div>

            <!-- Current Question -->
            <div id="question-container" class="bg-blue-50 rounded-2xl p-6 md:p-8 border-2 border-blue-100 mb-8">
                <div class="flex flex-col md:flex-row items-center mb-6">
                    <div class="flex justify-center mb-4 md:mb-0">
                        <img src="https://cdn-icons-png.flaticon.com/512/3898/3898671.png" alt="Math Question"
                            class="w-32 h-32" />
                    </div>
                    <div class="md:w-3/4 md:pl-6">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                            Tính nhẩm: 7 + 8 = ?
                        </h2>
                        <p class="text-lg text-gray-700">Hãy chọn đáp án đúng nhé!</p>
                    </div>
                </div>

                <!-- Answer Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button
                        class="option-card bg-white p-6 rounded-xl border-2 border-gray-200 hover:border-primary-300 text-left flex items-center"
                        data-value="13">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                            A
                        </div>
                        <span class="text-xl font-bold text-gray-800">13</span>
                    </button>

                    <button
                        class="option-card bg-white p-6 rounded-xl border-2 border-gray-200 hover:border-primary-300 text-left flex items-center"
                        data-value="14">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                            B
                        </div>
                        <span class="text-xl font-bold text-gray-800">14</span>
                    </button>

                    <button
                        class="option-card bg-white p-6 rounded-xl border-2 border-gray-200 hover:border-primary-300 text-left flex items-center"
                        data-value="15">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                            C
                        </div>
                        <span class="text-xl font-bold text-gray-800">15</span>
                    </button>

                    <button
                        class="option-card bg-white p-6 rounded-xl border-2 border-gray-200 hover:border-primary-300 text-left flex items-center"
                        data-value="16">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center mr-4 text-primary-600 font-bold">
                            D
                        </div>
                        <span class="text-xl font-bold text-gray-800">16</span>
                    </button>
                </div>
            </div>

            <!-- Feedback (Hidden by default) -->
            <div id="feedback-correct" class="hidden bg-green-100 border-2 border-green-200 rounded-2xl p-6 mb-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-green-200 flex items-center justify-center mr-4">
                        <i class="fas fa-check text-2xl text-green-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-green-800">Đúng rồi!</h3>
                        <p class="text-green-700 explanation">
                            Bạn đã trả lời đúng và nhận được 100 điểm.
                        </p>
                    </div>
                </div>
            </div>

            <div id="feedback-wrong" class="hidden bg-red-100 border-2 border-red-200 rounded-2xl p-6 mb-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-red-200 flex items-center justify-center mr-4">
                        <i class="fas fa-times text-2xl text-red-600"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-red-800">Chưa đúng!</h3>
                        <p class="text-red-700 explanation">
                            Đáp án đúng là 15. Hãy cố gắng ở câu tiếp theo nhé!
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex justify-between">
                <button id="prev-btn"
                    class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Câu trước
                </button>
                <button id="next-btn"
                    class="px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 flex items-center">
                    Câu tiếp theo
                    <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>

   <!-- Quiz Results (Hidden by default) -->
<section id="quiz-results" class="hidden py-12 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-blue-50 rounded-2xl p-8 border-2 border-blue-100 text-center">
                <div class="mb-6">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Trophy" class="w-32 h-32 mx-auto floating" />
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Chúc mừng bạn đã hoàn thành!
                </h2>
                <div class="text-5xl font-bold text-primary-600 mb-6" id="final-score">0 điểm</div>

                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="bg-white rounded-xl p-4 border-2 border-gray-200">
                        <div class="text-2xl font-bold text-gray-900" id="correct-answers">0/0</div>
                        <div class="text-gray-600">Câu đúng</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 border-2 border-gray-200">
                        <div class="text-2xl font-bold text-gray-900" id="quiz-time">0:00</div>
                        <div class="text-gray-600">Thời gian</div>
                    </div>
                    <div class="bg-white rounded-xl p-4 border-2 border-gray-200">
                        <div class="text-2xl font-bold text-yellow-500" id="quiz-stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="text-gray-600">Xếp hạng</div>
                    </div>
                </div>

                <div class="bg-primary-50 rounded-xl p-6 border-2 border-primary-100 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">
                        Bạn đã nhận được huy hiệu mới!
                    </h3>
                    <div class="flex justify-center space-x-4" id="badges-container">
                        <!-- Badges will be dynamically added here based on performance -->
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <button id="restart-btn" class="px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors duration-200">
                        <i class="fas fa-redo mr-2"></i>
                        Làm lại bài
                    </button>
                    <button id="share-btn" class="px-6 py-3 bg-accent-500 text-white font-bold rounded-xl hover:bg-accent-600 transition-colors duration-200">
                        <i class="fas fa-share-alt mr-2"></i>
                        Chia sẻ kết quả
                    </button>
                    <a href="{{route('quiz.index')}}" class="px-6 py-3 bg-secondary-500 text-white font-bold rounded-xl hover:bg-secondary-600 transition-colors duration-200 text-center">
                        <i class="fas fa-book mr-2"></i>
                        Quay lại danh sách quiz
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Leaderboard Section -->
    <section class="py-12 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                Bảng xếp hạng
            </h2>

            <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-md overflow-hidden">
                <div class="bg-primary-50 p-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-bold text-gray-900">Top 5 người chơi</h3>
                        <div class="text-sm text-gray-500">Cập nhật: Hôm nay</div>
                    </div>
                </div>
                <div class="p-4">
                    <ul class="space-y-4">
                        <!-- Rank 1 -->
                        <li
                            class="flex items-center justify-between p-3 bg-yellow-50 rounded-xl border-2 border-yellow-100">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4 text-yellow-600 font-bold">
                                    1
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ asset('logo.png') }}" alt="User"
                                        class="w-10 h-10 rounded-full mr-3 border-2 border-yellow-300" />
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Minh Anh</h4>
                                        <div class="text-sm text-gray-500">Lớp 2A</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="text-xl font-bold text-yellow-600">950</div>
                                <div class="ml-2 text-yellow-500">
                                    <i class="fas fa-crown"></i>
                                </div>
                            </div>
                        </li>

                        <!-- Rank 2 -->
                        <li class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border-2 border-gray-100">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-4 text-gray-600 font-bold">
                                    2
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ asset('logo.png') }}" alt="User"
                                        class="w-10 h-10 rounded-full mr-3 border-2 border-gray-300" />
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Hoàng Nam</h4>
                                        <div class="text-sm text-gray-500">Lớp 2B</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xl font-bold text-gray-600">900</div>
                        </li>

                        <!-- Rank 3 -->
                        <li
                            class="flex items-center justify-between p-3 bg-orange-50 rounded-xl border-2 border-orange-100">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center mr-4 text-orange-600 font-bold">
                                    3
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ asset('logo.png') }}" alt="User"
                                        class="w-10 h-10 rounded-full mr-3 border-2 border-orange-300" />
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Linh Chi</h4>
                                        <div class="text-sm text-gray-500">Lớp 2A</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xl font-bold text-orange-600">850</div>
                        </li>

                        <!-- Rank 4 -->
                        <li class="flex items-center justify-between p-3 bg-white rounded-xl border-2 border-gray-100">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-4 text-gray-600 font-bold">
                                    4
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ asset('logo.png') }}" alt="User"
                                        class="w-10 h-10 rounded-full mr-3 border-2 border-gray-200" />
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Tuấn Anh</h4>
                                        <div class="text-sm text-gray-500">Lớp 2C</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xl font-bold text-gray-600">820</div>
                        </li>

                        <!-- Rank 5 -->
                        <li class="flex items-center justify-between p-3 bg-white rounded-xl border-2 border-gray-100">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-4 text-gray-600 font-bold">
                                    5
                                </div>
                                <div class="flex items-center">
                                    <img src="{{ asset('logo.png') }}" alt="User"
                                        class="w-10 h-10 rounded-full mr-3 border-2 border-gray-200" />
                                    <div>
                                        <h4 class="text-lg font-bold text-gray-900">Hà My</h4>
                                        <div class="text-sm text-gray-500">Lớp 2B</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-xl font-bold text-gray-600">780</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        
        document.addEventListener("DOMContentLoaded", function() {
            // Quiz data
            const assetPath = "{{asset('')}}"
            const questions = @json($quizQuestions);
            questions.forEach(question => {

                question.thumbnail =  assetPath + question.thumbnail;
                if (typeof question.answers === 'string') {
                    question.answer = JSON.parse(question.answers);
                }
            });
            console.log(questions);
            
            function loadQuestion(index) {
                const question = questions[index];
                document.querySelector("#question-container h2").textContent = question.title;
                document.querySelector("#question-container img").src = question.thumbnail;

                optionButtons.forEach((btn) => {
                    btn.classList.remove(
                        "border-green-500",
                        "border-red-500",
                        "bg-green-50",
                        "bg-red-50",
                        "correct-answer",
                        "wrong-answer"
                    );
                });

                // Ẩn feedback
                feedbackCorrect.classList.add("hidden");
                feedbackWrong.classList.add("hidden");

                // Cập nhật nội dung các đáp án
                const answers = ['a', 'b', 'c', 'd'];
                optionButtons.forEach((button, i) => {
                    const key = answers[i];
                    button.setAttribute("data-value", key);
                    button.querySelector("span").textContent = question.answer[key];
                });

                // Ẩn/hiện nút prev/next tùy theo vị trí câu hỏi
                prevButton.style.visibility = index === 0 ? "hidden" : "visible";
                nextButton.style.visibility = index === questions.length - 1 ? "hidden" : "visible";

                // Reset timer
                clearInterval(timerInterval);
                timeLeft = 15;
                startTimer();
            }

            let currentQuestionIndex = 0;
            // Quiz options handling
            const optionButtons = document.querySelectorAll(".option-card");
            const feedbackCorrect = document.getElementById("feedback-correct");
            const feedbackWrong = document.getElementById("feedback-wrong");
            const nextButton = document.getElementById("next-btn");
            const prevButton = document.getElementById("prev-btn");
            const scoreElement = document.getElementById("score");
            const timerElement = document.getElementById("timer");
            const timerBar = document.getElementById("timer-bar");

            let score = 0;
            let timeLeft = 15;
            let timerInterval;

            // Xử lý nút câu trước
            prevButton.addEventListener("click", function() {
                if (currentQuestionIndex > 0) {
                    currentQuestionIndex--;
                    orderQuestion.textContent = orderQuestion.textContent - 1;
                    loadQuestion(currentQuestionIndex);

                    // Hiển thị lại section câu hỏi nếu đang ở màn hình kết quả
                    document.getElementById("quiz-results").classList.add("hidden");
                    document.querySelector("section.py-8.bg-white").classList.remove("hidden");

                    // Ẩn/hiện nút prev/next tùy theo vị trí câu hỏi
                    prevButton.style.visibility = currentQuestionIndex === 0 ? "hidden" : "visible";



                }
            });

            // Cập nhật lại hàm loadQuestion để xử lý hiển thị nút prev/next
            function loadQuestion(index) {
                const question = questions[index];
                document.querySelector("#question-container h2").textContent = question.title;
                document.querySelector("#question-container img").src = question.thumbnail;

                // Reset các style của đáp án trước khi load câu hỏi mới
                optionButtons.forEach((btn) => {
                    btn.classList.remove(
                        "border-green-500",
                        "border-red-500",
                        "bg-green-50",
                        "bg-red-50",
                        "correct-answer",
                        "wrong-answer"
                    );
                });

                // Ẩn feedback
                feedbackCorrect.classList.add("hidden");
                feedbackWrong.classList.add("hidden");

                //   optionButtons.forEach((button, i) => {
                //     button.setAttribute("data-value", question.options[i].value);
                //     button.querySelector("span").textContent = question.options[i].label;
                //   });

                const answers = ['a', 'b', 'c', 'd'];
                optionButtons.forEach((button, i) => {
                    const key = answers[i];
                    button.setAttribute("data-value", key);
                    button.querySelector("span").textContent = question.answer[key];
                });

                // Ẩn/hiện nút prev/next tùy theo vị trí câu hỏi
                prevButton.style.visibility = index === 0 ? "hidden" : "visible";

                // Reset timer
                clearInterval(timerInterval);
                timeLeft = 15;
                startTimer();
            }

            // Khởi tạo ẩn nút prev khi bắt đầu
            prevButton.style.visibility = "hidden";

            // Start with first question
            loadQuestion(currentQuestionIndex);

            // Handle option selection
            // Thêm mảng để lưu các câu hỏi đã trả lời đúng
            let answeredCorrectly = [];

            optionButtons.forEach((button) => {
              button.addEventListener("click", function () {
                    // Clear any previous selections
                    optionButtons.forEach((btn) => {
                        btn.classList.remove(
                            "border-green-500",
                            "border-red-500",
                            "bg-green-50",
                            "bg-red-50"
                        );
                    });

                    // Clear feedback
                    feedbackCorrect.classList.add("hidden");
                    feedbackWrong.classList.add("hidden");

                    // Stop timer
                    clearInterval(timerInterval);

                    const selectedValue = this.getAttribute("data-value");
                    const currentQuestion = questions[currentQuestionIndex];
                    const correctAnswer = currentQuestion.correct_answer;

                    if (selectedValue === correctAnswer) {
                        // Correct answer
                        this.classList.add(
                            "border-green-500",
                            "bg-green-50",
                            "correct-answer"
                        );
                        feedbackCorrect.classList.remove("hidden");

                        // Add points
                        // Chỉ cộng điểm nếu câu hỏi chưa được trả lời đúng trước đó
                        if (!answeredCorrectly.includes(currentQuestionIndex)) {
                            score += 100;
                            scoreElement.textContent = score;
                            answeredCorrectly.push(currentQuestionIndex);
                        }

                        // Show confetti effect
                        createConfetti();
                    } else {
                        // Wrong answer
                        this.classList.add("border-red-500", "bg-red-50", "wrong-answer");
                        feedbackWrong.classList.remove("hidden");
                        
                        // Hiển thị giải thích
                        if (currentQuestion.explanation) {
                            feedbackWrong.querySelector('.explanation').textContent = currentQuestion.explanation;
                        }

                        // Highlight correct answer
                        optionButtons.forEach((btn) => {
                            if (btn.getAttribute("data-value") === correctAnswer) {
                                btn.classList.add("border-green-500", "bg-green-50");
                            }
                        });
                    }
                });
            });

            // Next button click
            const orderQuestion = document.getElementById('order-question')
            nextButton.addEventListener("click", function() {
                if (currentQuestionIndex < questions.length - 1) {
                    currentQuestionIndex++;
                    orderQuestion.textContent = parseInt(orderQuestion.textContent, 10) + 1
                    loadQuestion(currentQuestionIndex);
                } else {

                        // Tính số câu đúng và sai
                    const correctCount = answeredCorrectly.length;
                    const wrongCount = questions.length - correctCount;
                    
                    // Cập nhật số liệu trong modal
                    document.getElementById('correct-answers').textContent = correctCount;
                    document.getElementById('wrong-answers').textContent = wrongCount;
                    
                    // Hiển thị modal
                    const modal = document.getElementById('completion-modal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    console.log(answeredCorrectly);
                    
                    //  fetch tạo lịch sử chơi quiz
                    
                }
            });

            document.getElementById('closeCompletionModalBtn').addEventListener('click', closeCompletionModal);

            function closeCompletionModal() {
                const modal = document.getElementById('completion-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.getElementById('correct-answers').textContent = `${answeredCorrectly.length}/${questions.length}`;
                
                // Hiển thị kết quả chi tiết
                document.getElementById("quiz-results").classList.remove("hidden");
                document.querySelector("section.py-8.bg-white").classList.add("hidden");
            }

            // Thêm xử lý cho nút chơi lại
            const restartButton = document.getElementById("restart-btn");
            restartButton.addEventListener('click', function() {
                // Reset các giá trị về ban đầu
                score = 200;
                currentQuestionIndex = 0;
                scoreElement.textContent = score;

                // Ẩn kết quả và hiện lại phần câu hỏi
                document.getElementById("quiz-results").classList.add("hidden");
                document.querySelector("section.py-8.bg-white").classList.remove("hidden");

                // Tải lại câu hỏi đầu tiên
                loadQuestion(currentQuestionIndex);

                // Reset timer
                clearInterval(timerInterval);
                timeLeft = 15;
                startTimer();

                // Reset màu của timer bar
                timerBar.classList.remove("bg-red-500");
                timerBar.classList.add("bg-secondary-500");
                timerBar.style.width = "100%";

                // Xóa các trạng thái đáp án
                optionButtons.forEach((btn) => {
                    btn.classList.remove(
                        "border-green-500",
                        "border-red-500",
                        "bg-green-50",
                        "bg-red-50",
                        "correct-answer",
                        "wrong-answer"
                    );
                });

                // Ẩn feedback
                feedbackCorrect.classList.add("hidden");
                feedbackWrong.classList.add("hidden");
            });

            // Timer function
            function startTimer() {
                timerInterval = setInterval(function() {
                    timeLeft--;

                    // Update timer display
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    timerElement.textContent = `${minutes
          .toString()
          .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

                    // Update timer bar
                    const percentage = (timeLeft / 15) * 100;
                    timerBar.style.width = `${percentage}%`;

                    // Change color based on time left
                    if (timeLeft <= 5) {
                        timerBar.classList.remove("bg-secondary-500");
                        timerBar.classList.add("bg-red-500");
                    }

                    // Time's up
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);

                        const currentQuestion = questions[currentQuestionIndex];
                        const correctAnswer = currentQuestion.correct_answer;
                        // Show time's up message
                        feedbackWrong.classList.remove("hidden");
                        document.querySelector("#feedback-wrong h3").textContent =
                            "Hết giờ!";
                        document.querySelector("#feedback-wrong p").textContent =
                            currentQuestion.explanation;

                        // Highlight correct answer
                        optionButtons.forEach((btn) => {
                            if (btn.getAttribute("data-value") === correctAnswer) {
                                btn.classList.add("border-green-500", "bg-green-50");
                            }
                        });
                    }
                }, 1000);
            }

            // Confetti effect
            function createConfetti() {
                const confettiContainer = document.createElement("div");
                confettiContainer.style.position = "fixed";
                confettiContainer.style.top = "0";
                confettiContainer.style.left = "0";
                confettiContainer.style.width = "100%";
                confettiContainer.style.height = "100%";
                confettiContainer.style.pointerEvents = "none";
                confettiContainer.style.zIndex = "9999";
                document.body.appendChild(confettiContainer);

                const colors = [
                    "#f44336",
                    "#e91e63",
                    "#9c27b0",
                    "#673ab7",
                    "#3f51b5",
                    "#2196f3",
                    "#03a9f4",
                    "#00bcd4",
                    "#009688",
                    "#4CAF50",
                    "#8BC34A",
                    "#CDDC39",
                    "#FFEB3B",
                    "#FFC107",
                    "#FF9800",
                    "#FF5722",
                ];

                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement("div");
                    confetti.style.position = "absolute";
                    confetti.style.width = `${Math.random() * 10 + 5}px`;
                    confetti.style.height = `${Math.random() * 10 + 5}px`;
                    confetti.style.backgroundColor =
                        colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.opacity = "0";
                    confetti.style.top = "-20px";
                    confetti.style.left = `${Math.random() * 100}%`;
                    confettiContainer.appendChild(confetti);

                    // Animate confetti
                    const duration = Math.random() * 3 + 2;
                    const delay = Math.random() * 0.5;

                    confetti.animate(
                        [{
                                transform: "translateY(0) rotate(0)",
                                opacity: 1
                            },
                            {
                                transform: `translateY(${window.innerHeight}px) rotate(${
                Math.random() * 360
              }deg)`,
                                opacity: 0,
                            },
                        ], {
                            duration: duration * 1000,
                            delay: delay * 1000,
                            easing: "cubic-bezier(0.1, 0.8, 0.3, 1)",
                            fill: "forwards",
                        }
                    );
                }

                // Remove confetti container after animation
                setTimeout(() => {
                    confettiContainer.remove();
                }, 5000);
            }
        });
    </script>
@endpush

<!-- Thêm vào cuối file, trước  -->

<!-- Completion Modal -->
<div id="completion-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 max-w-md mx-4 relative animate-bounce-in">
        <div class="text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Congratulations" class="w-24 h-24 mx-auto mb-4 floating">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Chúc mừng con đã hoàn thành!</h2>
            <div class="mb-6">
                <p class="text-lg text-gray-700">Con đã trả lời đúng <span id="correct-answers" class="font-bold text-green-600">0</span> câu</p>
                <p class="text-lg text-gray-700">Và trả lời sai <span id="wrong-answers" class="font-bold text-red-600">0</span> câu</p>
            </div>
            <button id="closeCompletionModalBtn" class="bg-primary-600 text-white px-6 py-2 rounded-xl hover:bg-primary-700 transition-colors">
                Xem kết quả chi tiết
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes bounce-in {
        0% { transform: scale(0.3); opacity: 0; }
        50% { transform: scale(1.05); opacity: 0.8; }
        70% { transform: scale(0.9); opacity: 0.9; }
        100% { transform: scale(1); opacity: 1; }
    }
    .animate-bounce-in {
        animation: bounce-in 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
</style>
