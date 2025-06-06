@extends('client.layouts.layout', [
    'indexMenu' => 2,
])
@section('content')
    <!-- Hero Section -->
    <section class="hero-bg py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/80 to-secondary-500/80"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                        Học tập vui vẻ cùng
                        <span class="text-secondary-300">Tài Liệu Tiểu Học</span>!
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

    <section class="py-8 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <form action="" class="flex gap-2">
                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c] min-w-[200px]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1">Môn
                        học</p>
                    <select name="subject_id" id="" class="outline-0 w-full">
                        <option value="">Tất cả</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ request()->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c] min-w-[200px]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1">Lớp
                        học</p>
                    <select name="class_id" id="" class="outline-0 w-full">
                        <option value="">Tất cả</option>
                        @foreach ($classes as $id => $class)
                            <option value="{{ $class->id }}" {{ request()->class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}</option>
                        @endforeach

                    </select>
                </label>


                <button type="submit" class="bg-[#dd326c] rounded px-3 text-white transition-all active:scale-[1.1]"> Xác
                    nhận </button>
            </form>
        </div>
    </section>

    <section class="py-12 bg-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @role(99)
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Chương học các môn</h2>
                    <a href="{{route('admin.lesson-type.create')}}" class="flex group items-center bg-[#14a126] text-white px-10 py-5 rounded-2xl  gap-2 relative ">
                        Thêm chương học
                        <svg class="absolute left-[10px] group-hover:left-full group-hover:translate-x-[-120%] group-hover:skew-x-[360deg] transition-all top-1/2  translate-y-[-50%]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7v6m-8 6.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20M9 10h6"/></svg>
                    </a>
                </div>
            @endrole

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($lessonTypes as $lessonType)
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden course-card">
                        <div class="relative">
                            <img src="{{ $lessonType->thumbnail }}" alt="Math Quiz" class="w-full h-48 object-cover" />
                            <div
                                class="absolute top-4 right-4 bg-primary-500 text-white text-sm font-bold px-3 py-1 rounded-full">
                                <i class="fas fa-book-reader mr-1"></i> {{ count($lessonType->lessons) }} bài học
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="bg-primary-100 text-primary-800 text-xs font-bold px-2 py-1 rounded">{{ $lessonType->class?->name }}</span>
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">{{ $lessonType->subject?->name }}</span>

                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $lessonType->name }}
                            </h3>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <i class="fas fa-star mr-2"></i>
                                <span>{{ $lessonType->description }}</span>
                            </div>
                            <div class="flex gap-2">
                                @role(99)
                                    <a href="{{route('lession.create', [ 'lesson_type_id' => $lessonType->id])}}"
                                    class="flex-1 inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-base font-bold rounded-xl text-white bg-[#8f409b] hover:bg-[#693771]"
                                    >
                                    Thêm bài giảng
                                    </a>
                                @endrole
                                <a href="{{ route('lesson_type.list', $lessonType->id) }}"
                                    data-number-of-lesson="{{ count($lessonType->lessons) ?? 0 }}"
                                    class="flex-1 inline-flex items-center justify-center w-full px-4 py-2 border border-transparent text-base font-bold rounded-xl text-white bg-primary-600 hover:bg-primary-700">
                                    <i class="fas fa-play mr-2"></i>
                                    Xem {{ count($lessonType->lessons) ?? 0 }} bài giảng
                                </a>
                            </div>
                            
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let toastTimer; 
            const lessonTypeButtons = document.querySelectorAll('a[data-number-of-lesson]');
            lessonTypeButtons.forEach(element => {
                element.addEventListener('click', function(e) {
                    var numberOfLesson = element.getAttribute('data-number-of-lesson');
                    if (numberOfLesson == 0) {
                        e.preventDefault();
                        window.toastLabel.textContent = 'Chương học này chưa có bài giảng nào';
                        if (toastTimer) {
                            clearInterval(toastTimer);
                        }
                        toastOpen()
                        toastTimer = setInterval(()=>{
                        toastClose()
                     },2000)
                        
                    }
                })

            });

        })
    </script>
@endpush
