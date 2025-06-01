@extends('client.layouts.layout', [
    'indexMenu' => 4,
])

@section('content')
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 py-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/80 to-secondary-500/80"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-2/3 text-center md:text-left mb-6 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Tổng hợp Tài Liệu Học Tập</h1>
                    <p class="text-lg text-white text-stroke-3">Tạo và chia sẻ tài liệu học tập hấp dẫn cho học sinh!</p>
                </div>
                <div class="md:w-1/3 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Create Document"
                        class="w-32 h-32 floating">
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
                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1">Môn
                        học</p>
                    <select name="subject_id" id="" class="outline-0">
                        <option value="">Tất cả</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ request()->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1">Lớp
                        học</p>
                    <select name="class_id" id="" class="outline-0">
                        <option value="">Tất cả</option>
                        @foreach ($classes as $id => $class)
                            <option value="{{ $class->id }}" {{ request()->class_id == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}</option>
                        @endforeach

                    </select>
                </label>

                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1">Kiểu
                        tài liệu</p>
                    <select name="type" id="" class="outline-0">
                        <option value="">Tất cả</option>
                        @foreach ($types as $key => $type)
                            <option value="{{ $key }}" {{ request()->type == $key ? 'selected' : '' }}>
                                {{ $type }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1"> Sắp xếp </p>
                    <select name="sort" id="" class="outline-0">
                        <option value="asc" {{request()->sort == "asc" ? "selected" : ""}} >Cũ nhất</option>
                        <option value="desc" {{request()->sort == "desc" ? "selected" : ""}} >Mới nhất</option>
                    </select>
                </label>

                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1">Từ
                        khoá</p>
                    <input type="text" name="keyword" class="outline-0" placeholder="Tìm kiếm...">
                </label>

                <button type="submit" class="bg-[#dd326c] rounded px-3 text-white transition-all active:scale-[1.1]"> Xác
                    nhận </button>
            </form>
            @role(99)
            <a href="{{route('document.create')}}"  class="bg-[#2563eb] w-fit flex justify-center items-center gap-2 rounded px-3 text-white transition-all active:scale-[1.1] my-5 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32"/></svg> 
                <span>Thêm tài liệu</span>
             </a>
             @endrole
        </div>
    </section>
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @foreach ($documents as $document)
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition mb-6 ">
                    <div class="p-5 documents-container">
                        <div class="flex items-center mb-3">
                            <div class=" bg-blue-100 rounded-lg flex items-center justify-center mr-3 p-1">
                                <img src="{{asset($document->thumbnail)}}" class="w-[80px] h-[80px] object-cover rounded" alt=""
                                onerror="this.onerror=null; this.src='{{ asset('assets/images/failed.gif') }}';"
                                >
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">{{ $document->title }} - <span class="text-sm  text-gray-500 italic">Đăng tải lúc {{$document->created_at}}</span></h3>
                                <div class="flex gap-2">
                                    <p class=" text-sm py-1 px-4 font-bold my-2 bg-green-200 rounded text-green-700 w-fit">
                                        {{ $document->subject?->name }}</p>
                                    <p
                                        class=" text-sm py-1 px-4 font-bold my-2 bg-purple-200 rounded text-purple-700 w-fit">
                                        {{ $document->class?->name }}</p>
                                </div>

                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">{{ $document->description }}</p>
                        <div class="flex gap-2">
                            @foreach ($document->tags as $tag )
                                <p class=" text-sm py-1 px-4 font-bold my-2 bg-[#f39118] rounded text-white w-fit">#{{ $tag ?? '' }}</p>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Bộ {{ count(json_decode($document->documents)) }} file tài
                                liệu</span>
                            <div class="flex gap-2">

                                <button
                                    class="show-full-documents px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-sm border-2 border-amber-600">Danh sách file</button>

                            </div>
                        </div>
                        <div class=" border-2 border-gray-200 rounded py-2 pl-5 my-2 documents-list hidden">
                            @foreach (json_decode($document->documents) as $file)
                                <div
                                    class="text-sm text-blue-500 hover:bg-gray-100 p-1 flex items-center gap-2 justify-between ">
                                    <p class="flex items-center gap-2 justify-start">
                                        <span>
                                            {{ $loop->index + 1 }}.
                                        </span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-width="2">
                                                        <path
                                                            d="M13.172 3H9c-1.886 0-2.828 0-3.414.586S5 5.114 5 7v10c0 1.886 0 2.828.586 3.414S7.114 21 9 21h6c1.886 0 2.828 0 3.414-.586S19 18.886 19 17V8.828c0-.408 0-.613-.076-.796s-.22-.329-.51-.618l-3.828-3.828c-.29-.29-.434-.434-.617-.51C13.785 3 13.58 3 13.172 3Z" />
                                                        <path d="M13 3v4c0 .943 0 1.414.293 1.707S14.057 9 15 9h4" />
                                                    </g>
                                                </svg>
                                        {{ $file->name }}
                                    </p>
                                    <div class="flex gap-2">
                                        <form action="{{ route('download.download') }}"
                                            data-tippy-content="Tải về file này" method="POST">
                                            @csrf
                                            <input type="hidden" name="file" value="{{ $file->file }}">
                                            <button data-tippy-content="Tải về file này"
                                                class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-sm"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2">
                                                        <path fill="currentColor" fill-opacity="0" stroke-dasharray="20"
                                                            stroke-dashoffset="20"
                                                            d="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5">
                                                            <animate attributeName="d" begin="0.5s" dur="1.5s"
                                                                repeatCount="indefinite"
                                                                values="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5;M12 4h2v3h2.5l-4.5 4.5M12 4h-2v3h-2.5l4.5 4.5;M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5" />
                                                            <animate fill="freeze" attributeName="fill-opacity"
                                                                begin="0.7s" dur="0.5s" values="0;1" />
                                                            <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                dur="0.4s" values="20;0" />
                                                        </path>
                                                        <path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12">
                                                            <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                begin="0.5s" dur="0.2s" values="14;0" />
                                                        </path>
                                                    </g>
                                                </svg></button>
                                        </form>
                                        @if (pathinfo($file->file, PATHINFO_EXTENSION) != 'zip')
                                            <a
                                            data-tippy-content="Xem trước file này"
                                            href="{{ route('file_preview', [
                                                'fileName' => $file->file,
                                            ]) }}"
                                                target="_blank"
                                                class="px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-sm">Đọc</a>
                                        @endif
                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const showAllDocBtns = document.querySelectorAll(".show-full-documents");
            showAllDocBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    btn.closest('.documents-container').querySelector('.documents-list').classList
                        .toggle('hidden')
                })
            })
        })
    </script>
@endpush
