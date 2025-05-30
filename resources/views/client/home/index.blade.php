@extends('client.layouts.layout')
@section('content')
    <!-- Hero Section -->
    <section class="hero-bg py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/80 to-secondary-500/80"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        Học tập vui vẻ cùng
                        <span class="text-secondary-300">KidsLearn</span>!
                    </h1>
                    <p class="text-xl text-white mb-8">
                        Khám phá thế giới kiến thức qua các bài học thú vị và trò chơi hấp
                        dẫn dành cho các bạn nhỏ.
                    </p>
                    <div
                        class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center md:justify-start">
                        <a href="#"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-lg font-bold rounded-xl text-primary-700 bg-white hover:bg-gray-100">
                            Bắt đầu học ngay
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#"
                            class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-lg font-bold rounded-xl text-white hover:bg-white/20">
                            <i class="fas fa-play mr-2"></i>
                            Xem hướng dẫn
                        </a>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/4090/4090217.png" alt="Kids Learning"
                        class="w-64 h-64 floating" />
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

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-primary-50 rounded-2xl p-6 border-2 border-primary-100">
                    <div class="text-4xl font-bold text-primary-600 mb-2">12</div>
                    <div class="text-lg text-gray-700">Bài học đã hoàn thành</div>
                </div>
                <div class="bg-secondary-50 rounded-2xl p-6 border-2 border-secondary-100">
                    <div class="text-4xl font-bold text-secondary-600 mb-2">5</div>
                    <div class="text-lg text-gray-700">Huy hiệu đã nhận</div>
                </div>
                <div class="bg-accent-50 rounded-2xl p-6 border-2 border-accent-100">
                    <div class="text-4xl font-bold text-accent-600 mb-2">320</div>
                    <div class="text-lg text-gray-700">Điểm số</div>
                </div>
                <div class="bg-purple-50 rounded-2xl p-6 border-2 border-purple-100">
                    <div class="text-4xl font-bold text-purple-600 mb-2">8</div>
                    <div class="text-lg text-gray-700">Ngày học liên tiếp</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Continue Learning Section -->
    <section class="py-12 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Tiếp tục học</h2>
                <a href="#" class="text-primary-600 hover:text-primary-700 font-bold flex items-center">
                    Xem tất cả
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Course 1 -->
                @foreach ($lessons as $lesson )
                <div class="bg-white rounded-2xl shadow-md overflow-hidden course-card">
                    <div class="relative">
                        <img src="{{asset($lesson->thumbnail) ?? ''}}"
                            alt="Math Course" class="w-full h-48 object-cover" />
                        <div
                            class="absolute top-4 right-4 bg-secondary-500 text-white text-sm font-bold px-3 py-1 rounded-full">
                            {{$lesson->myLessonProgress?->progress}}% hoàn thành
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-primary-100 text-primary-800 text-xs font-bold px-2 py-1 rounded">
                                {{$lesson->lessonType?->subject?->name}}
                            </span>
                            <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">{{$lesson->lessonType?->class?->name}}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{$lesson->lessonType?->course?->name}}
                        </h3>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-book mr-2"></i>
                            <span>12 bài học</span>
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            <span>45 phút</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-secondary-500 h-2.5 rounded-full" style="width: {{$lesson->myLessonProgress?->progress}}%"></div>
                        </div>
                        <a href="{{route('lession.show', $lesson->id)}}"
                            class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700">
                            Tiếp tục học
                        </a>
                    </div>
                </div>
                @endforeach
               

                {{-- <!-- Course 2 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden course-card">
                    <div class="relative">
                        <img src="https://img.freepik.com/free-vector/hand-drawn-vietnamese-language-background_23-2149483215.jpg"
                            alt="Vietnamese Course" class="w-full h-48 object-cover" />
                        <div
                            class="absolute top-4 right-4 bg-secondary-500 text-white text-sm font-bold px-3 py-1 rounded-full">
                            40% hoàn thành
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-purple-100 text-purple-800 text-xs font-bold px-2 py-1 rounded">Tiếng
                                Việt</span>
                            <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Lớp 2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            Học đọc và viết chữ tiếng Việt
                        </h3>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-book mr-2"></i>
                            <span>15 bài học</span>
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            <span>60 phút</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-secondary-500 h-2.5 rounded-full" style="width: 40%"></div>
                        </div>
                        <a href="#"
                            class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700">
                            Tiếp tục học
                        </a>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="bg-white rounded-2xl shadow-md overflow-hidden course-card">
                    <div class="relative">
                        <img src="https://img.freepik.com/free-vector/hand-drawn-science-education-background_23-2148499325.jpg"
                            alt="Science Course" class="w-full h-48 object-cover" />
                        <div
                            class="absolute top-4 right-4 bg-secondary-500 text-white text-sm font-bold px-3 py-1 rounded-full">
                            20% hoàn thành
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-accent-100 text-accent-800 text-xs font-bold px-2 py-1 rounded">Khoa học</span>
                            <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">Lớp 2</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            Khám phá thế giới tự nhiên
                        </h3>
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="fas fa-book mr-2"></i>
                            <span>10 bài học</span>
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            <span>30 phút</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                            <div class="bg-secondary-500 h-2.5 rounded-full" style="width: 20%"></div>
                        </div>
                        <a href="#"
                            class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700">
                            Tiếp tục học
                        </a>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                Khám phá theo môn học
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <a href="#" class="bg-primary-50 rounded-2xl p-6 text-center hover:bg-primary-100 transition-all">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calculator text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Toán học</h3>
                    <p class="text-gray-600">Học đếm, tính toán và giải toán</p>
                </a>

                <!-- Category 2 -->
                <a href="#" class="bg-purple-50 rounded-2xl p-6 text-center hover:bg-purple-100 transition-all">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tiếng Việt</h3>
                    <p class="text-gray-600">Học đọc, viết và văn học</p>
                </a>

                <!-- Category 3 -->
                <a href="#" class="bg-accent-50 rounded-2xl p-6 text-center hover:bg-accent-100 transition-all">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-flask text-2xl text-accent-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Khoa học</h3>
                    <p class="text-gray-600">Khám phá thế giới tự nhiên</p>
                </a>

                <!-- Category 4 -->
                <a href="#"
                    class="bg-secondary-50 rounded-2xl p-6 text-center hover:bg-secondary-100 transition-all">
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-globe text-2xl text-secondary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Tiếng Anh</h3>
                    <p class="text-gray-600">Học từ vựng và giao tiếp</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Learning Games Section -->
    <section class="py-12 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Chương học các môn</h2>
                <a href="#" class="text-primary-600 hover:text-primary-700 font-bold flex items-center">
                    Xem tất cả
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ( $lessonTypes as $lessonType )
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden course-card">
                        <div class="relative">
                            <img src="{{$lessonType->thumbnail}}"
                                alt="Math Quiz" class="w-full h-48 object-cover" />
                            <div
                                class="absolute top-4 right-4 bg-primary-500 text-white text-sm font-bold px-3 py-1 rounded-full">
                                <i class="fas fa-book-reader mr-1"></i> {{count($lessonType->lessons)}} bài học
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-primary-100 text-primary-800 text-xs font-bold px-2 py-1 rounded">{{$lessonType->class?->name}}</span>
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">{{$lessonType->subject?->name}}</span>

                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{$lessonType->name}}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-star mr-2"></i>
                                <span>{{$lessonType->description}}</span>
                            </div>
                            <a href="{{route('lesson_type.list', $lessonType->id)}}"
                                class="inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700">
                                <i class="fas fa-play mr-2"></i>
                                Xem danh sách
                            </a>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                Thành tựu của bạn
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
                <!-- Badge 1 -->
                <div class="badge flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-primary-100 flex items-center justify-center mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Badge"
                            class="w-16 h-16" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center">
                        Siêu sao Toán học
                    </h3>
                </div>

                <!-- Badge 2 -->
                <div class="badge flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-purple-100 flex items-center justify-center mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583344.png" alt="Badge"
                            class="w-16 h-16" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center">
                        Nhà văn tài năng
                    </h3>
                </div>

                <!-- Badge 3 -->
                <div class="badge flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-secondary-100 flex items-center justify-center mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/2583/2583319.png" alt="Badge"
                            class="w-16 h-16" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center">
                        Chăm chỉ học tập
                    </h3>
                </div>

                <!-- Badge 4 -->
                <div class="badge flex flex-col items-center">
                    <div class="w-24 h-24 rounded-full bg-accent-100 flex items-center justify-center mb-3">
                        <img src="https://cdn-icons-png.flaticon.com/512/3227/3227076.png" alt="Badge"
                            class="w-16 h-16" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-center">
                        Nhà khoa học nhí
                    </h3>
                </div>

                <!-- Badge 5 (Locked) -->
                <div class="badge flex flex-col items-center opacity-50">
                    <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center mb-3 relative">
                        <img src="https://cdn-icons-png.flaticon.com/512/3227/3227053.png" alt="Badge"
                            class="w-16 h-16 opacity-50" />
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="fas fa-lock text-gray-500 text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold text-gray-500 text-center">
                        Chưa mở khóa
                    </h3>
                </div>
            </div>

            <div class="mt-8 text-center">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-lg font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700">
                    Xem tất cả thành tựu
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-12 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">
                Tại sao chọn KidsLearn?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-gamepad text-2xl text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Học qua trò chơi
                    </h3>
                    <p class="text-gray-600">
                        Các bài học được thiết kế như trò chơi giúp các bạn nhỏ học tập
                        vui vẻ và hiệu quả.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-medal text-2xl text-secondary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Hệ thống phần thưởng
                    </h3>
                    <p class="text-gray-600">
                        Nhận huy hiệu và phần thưởng khi hoàn thành bài học, tạo động lực
                        học tập.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-chart-line text-2xl text-accent-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Theo dõi tiến độ
                    </h3>
                    <p class="text-gray-600">
                        Phụ huynh và giáo viên có thể theo dõi tiến độ học tập của các bạn
                        nhỏ.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
                Phụ huynh nói gì về chúng tôi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="bg-primary-50 rounded-2xl p-6 border-2 border-primary-100">
                    <div class="flex items-center mb-4">
                        <div class="text-primary-500 text-2xl">
                            <i class="fas fa-quote-left"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">
                        "Con tôi rất thích học trên KidsLearn. Các bài học vui nhộn và hấp
                        dẫn giúp con học tập hiệu quả mà không cảm thấy nhàm chán."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Parent"
                            class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <h4 class="font-bold text-gray-900">Chị Hương</h4>
                            <p class="text-gray-500 text-sm">Phụ huynh học sinh lớp 2</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-secondary-50 rounded-2xl p-6 border-2 border-secondary-100">
                    <div class="flex items-center mb-4">
                        <div class="text-secondary-500 text-2xl">
                            <i class="fas fa-quote-left"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">
                        "Tôi rất ấn tượng với cách KidsLearn kết hợp giữa học tập và giải
                        trí. Con tôi đã cải thiện đáng kể kỹ năng toán học và đọc hiểu."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Parent"
                            class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <h4 class="font-bold text-gray-900">Anh Minh</h4>
                            <p class="text-gray-500 text-sm">Phụ huynh học sinh lớp 3</p>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-accent-50 rounded-2xl p-6 border-2 border-accent-100">
                    <div class="flex items-center mb-4">
                        <div class="text-accent-500 text-2xl">
                            <i class="fas fa-quote-left"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">
                        "Là giáo viên, tôi thấy KidsLearn là công cụ tuyệt vời để hỗ trợ
                        việc dạy học. Học sinh của tôi rất hào hứng khi được học trên nền
                        tảng này."
                    </p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Teacher"
                            class="w-12 h-12 rounded-full mr-4" />
                        <div>
                            <h4 class="font-bold text-gray-900">Cô Thảo</h4>
                            <p class="text-gray-500 text-sm">Giáo viên tiểu học</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-primary-600 to-secondary-500 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white mb-6">
                    Sẵn sàng bắt đầu hành trình học tập?
                </h2>
                <p class="text-xl text-white mb-8">
                    Đăng ký ngay hôm nay để con bạn có thể học tập vui vẻ và hiệu quả!
                </p>
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                    <a href="#"
                        class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-lg font-bold rounded-xl text-primary-700 bg-white hover:bg-gray-100">
                        Đăng ký miễn phí
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center px-6 py-3 border-2 border-white text-lg font-bold rounded-xl text-white hover:bg-white/20">
                        Tìm hiểu thêm
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute left-10 bottom-10 w-20 h-20 opacity-20">
            <img src="https://cdn-icons-png.flaticon.com/512/3898/3898082.png" alt="Decoration"
                class="w-full h-full spin-slow" />
        </div>
        <div class="absolute right-10 top-10 w-16 h-16 opacity-20">
            <img src="https://cdn-icons-png.flaticon.com/512/3898/3898671.png" alt="Decoration"
                class="w-full h-full spin-slow" />
        </div>
    </section>
@endsection
