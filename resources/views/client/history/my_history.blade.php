@extends('client.layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="text-3xl font-extrabold mb-8 text-blue-700 text-center tracking-tight flex gap-[30px]">
            <button tab-target="exams" class="border-b-[10px] border-blue-700">Lịch sử làm kiểm tra</button>
            <button tab-target="progress">Tiến trình học</button>
        </div>

        <div tab="exams" class="bg-white shadow-xl rounded-2xl p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-100 to-blue-200">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tên kiểm tra</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Thuộc bài học</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Điểm</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Số câu hỏi</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Số câu đúng</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tỷ lệ đúng</th>
                        <th class="py-3 px-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Ngày làm</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($exams as $index => $exam)
                        <tr class="transition hover:bg-blue-50 {{ $exam->true_rate >= 0.75 ? 'bg-green-50' : 'bg-red-50' }}">
                            <td class="py-2 px-4 font-mono text-sm text-gray-500">{{ $exam->id }}</td>
                            <td class="py-2 px-4 font-semibold text-blue-700">{{ $exam->set->title }}</td>
                            <td class="py-2 px-4 text-gray-700">{{ $exam->lesson->title }}</td>
                            <td class="py-2 px-4 text-center">
                                <span class="inline-block px-2 py-1 rounded-full {{ $exam->score >= 8 ? 'bg-green-200 text-green-800' : ($exam->score >= 5 ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                    {{ $exam->score }}
                                </span>
                            </td>
                            <td class="py-2 px-4 text-center">{{ $exam->number_questions }}</td>
                            <td class="py-2 px-4 text-center">{{ $exam->correct_count }}</td>
                            <td class="py-2 px-4 text-center">
                                <span class="font-bold {{ $exam->true_rate >= 0.75 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ round($exam->true_rate * 100) }}%
                                </span>
                            </td>
                            <td class="py-2 px-4 text-gray-500 text-sm" title="{{ $exam->created_at->format('d/m/Y H:i') }}">
                                {{ $exam->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-6 px-4 text-center text-gray-400 italic">Bạn chưa có lịch sử làm kiểm tra nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div tab="progress" class="grid grid-cols-4 gap-6 mt-8">
            @foreach ($lessonProgresses as $lessonProgress )
            @php
                $lesson = $lessonProgress->lesson;
            @endphp
                <div class="bg-white rounded-2xl shadow-md overflow-hidden course-card">
                    <div class="relative">
                        <img src="{{asset($lesson->thumbnail) ?? ''}}"
                            alt="Math Course" class="w-full h-48 object-cover"
                            onerror="this.onerror=null; this.src='{{ asset('assets/images/failed.gif') }}';"
                            />
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
                            <span>{{$lesson->lessonType?->name}}</span>
                            <i class="fas fa-clock ml-4 mr-2"></i>
                            <span>{{$lesson->duration}} phút</span>
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

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            // Mặc định hiển thị tab "exams"
            $('[tab="exams"]').show();
            $('[tab="progress"]').hide();

            // Xử lý sự kiện click cho các nút tab
            $('button[tab-target]').click(function() {
                var target = $(this).attr('tab-target');
                $('button[tab-target]').removeClass('border-b-[10px] border-blue-700');
                $(this).addClass('border-b-[10px] border-blue-700');
                $('[tab]').hide();
                $('[tab="' + target + '"]').show();
            });
        });
    </script>
@endpush
