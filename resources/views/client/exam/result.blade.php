@extends('client.layouts.layout')
@push('styles')
    <style>
        .radial-progress {
            --value: 0;
            --size: 12rem;
            --thickness: 1rem;
            position: relative;
            display: inline-grid;
            place-items: center;
            border-radius: 9999px;
        }
        .radial-progress:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 9999px;
            opacity: 0.2;
            background: currentColor;
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(-5%); }
            50% { transform: translateY(0); }
        }
        .animate-bounce {
            animation: bounce 2s infinite;
        }
    </style>
@endpush  
@section('content')
<div class="container mx-auto px-4 my-4 py-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-indigo-600 mb-2 animate-bounce">🎉 Chúc mừng con!</h1>
        <p class="text-xl text-gray-600">Con đã hoàn thành bài tập</p>
    </div>

    <!-- Result Card -->
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden border-4 border-yellow-300 transform hover:scale-[1.02] transition duration-300">
        <!-- Progress Badge -->
        <div class="bg-gradient-to-r from-green-400 to-blue-500 p-4 text-center">
            <span class="inline-block px-4 py-2 bg-yellow-300 text-gray-800 font-bold rounded-full text-lg">
                @if($success['true_rate'] >= 0.8)
                ⭐ Xuất sắc!
                @elseif($success['true_rate'] >= 0.5)
                👍 Tốt lắm!
                @else
                😕 Cố gắng hơn nữa!
                @endif
            </span>
        </div>

        <!-- Result Content -->
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Score Summary -->
                <div class="flex-1 text-center">
                    <div class="radial-progress bg-white text-green-500 border-4 border-green-100" 
                         style="--value:85;">
                        <span class="text-4xl font-bold">{{$success['true_rate'] * 100 ?? 0}}%</span>
                    </div>
                    <p class="mt-4 text-gray-600">Số câu đúng: <span class="font-bold text-green-600">{{$success['correct_count']}}</span>/{{$success['number_questions']}}</p>
                </div>

                <!-- Details -->
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-indigo-700 mb-4">Chi tiết bài làm</h3>
                    
                    <!-- Time & Date -->
                    <div class="flex items-center mb-4 text-gray-600">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Điểm số: {{$history->score ?? 0}}</span>
                    </div>

                    <!-- Reward Badges -->
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-700 mb-2">Phần thưởng:</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Thiên tài
                            </span>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                </svg>
                                Siêu sao
                            </span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-3 mt-6">
                        <a href="{{route('lession.show', $history->lesson_id)}}" 
                           class="btn bg-green-500 hover:bg-green-600 text-white py-3 px-6 rounded-lg flex items-center justify-center transition">
                            Quay về bài giảng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fun Elements -->
    <div class="text-center mt-12 mb-4">
        <button id="confetti-btn" class="px-4 py-2 bg-pink-500 text-white rounded-full">
            🎉 Bấm để ăn mừng!
        </button>
    </div>

    <!-- list question -->
    @foreach ($result as $id => $ques )
        <div class="bg-white rounded-2xl border-2 border-amber-200 p-3 m-3">
            <p class="font-bold pb-5 mb-5 border-b-2 border-amber-500 text-[2rem] text-[#ec4899]">Câu {{$loop->index + 1}}: {{$ques['question']->content}}</p>
            <ul class="ml-4 flex flex-col gap-3">
                @foreach ( $ques['question']->answers as $word => $answer )
                    <li> 
                        <span class="inline-flex font-bold rounded-full items-center justify-center p-2  border-2 border-blue-300 
                        {{$word == $ques['question']->correct_answer ? "bg-green-500 text-white" : ""}}
                        {{($word == $ques['your_answer'] && $ques['your_answer'] != $ques['question']->correct_answer ) ? "bg-red-500 text-white" : ""}}
                        "
                        
                        >{{$word}}:</span> {!!$word == $ques['your_answer'] ? '<i>( Đáp án bạn chọn ) </i>' : ''!!} {{$answer}}</li>
                @endforeach
            </ul>
            <div class="flex gap-3 mt-3 pt-2 border-t-2 border-amber-500">
                <p class="font-bold">Giải thích: </p>    
                <p>{!! nl2br($ques['question']->explanation)!!}</p>
            </div> 
        </div>
    @endforeach
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>
    document.getElementById('confetti-btn').addEventListener('click', () => {
        confetti({
            particleCount: 150,
            spread: 70,
            origin: { y: 0.6 }
        });
    });
</script>
@endpush