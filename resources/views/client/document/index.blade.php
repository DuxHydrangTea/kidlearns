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
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1"> Đối tượng </p>
                    <select name="access" id="" class="outline-0">
                        <option value="">Tất cả</option>
                        <option value="public" {{request('access') == "public" ? "selected" : ""}}>Công khai</option>
                        <option value="private" {{request('access') == "private" ? "selected" : ""}}>Riêng tư</option>
                        <option value="restricted" {{request('access') == "restricted" ? "selected" : ""}}>Giới hạn (chỉ học sinh của tôi)</option>
                    </select>
                </label>

                <label class="border-2 border-gray-200 rounded p-2 relative hover:border-[#dd326c]">
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1"> Đối tượng </p>
                    <select name="sort" id="" class="outline-0">
                        <option value="desc" {{request()->sort == "desc" ? "selected" : ""}} >Cũ nhất</option>
                        <option value="asc" {{request()->sort == "asc" ? "selected" : ""}} >Mới nhất</option>
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
                                <img src="{{asset($document->thumbnail)}}" class="w-[80px] h-[80px] object-cover rounded" alt="">
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
                                        @switch(pathinfo($file->file, PATHINFO_EXTENSION))
                                            @case('zip')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                        <path
                                                            d="M7 13h2.877a.3.3 0 0 1 .234.487l-2.961 3.7a.5.5 0 0 0 .39.813h2.961m2.501-5h1.25m0 0h1.251m-1.25 0v4.81m-1.25.19h2.5m2.5 0v-5h1.466c.65 0 1.349.289 1.494.922c.05.215.05.424 0 .641c-.146.64-.85.937-1.508.937h-.45" />
                                                        <path
                                                            d="M15 22h-4.273c-3.26 0-4.892 0-6.024-.798a4.1 4.1 0 0 1-.855-.805C3 19.331 3 17.797 3 14.727v-2.545c0-2.963 0-4.445.469-5.628c.754-1.903 2.348-3.403 4.37-4.113C9.095 2 10.668 2 13.818 2c1.798 0 2.698 0 3.416.252c1.155.406 2.066 1.263 2.497 2.35C20 5.278 20 6.125 20 7.818V10" />
                                                        <path
                                                            d="M3 12a3.333 3.333 0 0 1 3.333-3.333c.666 0 1.451.116 2.098-.057A1.67 1.67 0 0 0 9.61 7.43c.173-.647.057-1.432.057-2.098A3.333 3.333 0 0 1 13 2" />
                                                    </g>
                                                </svg>
                                            @break

                                            @case('pdf')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                        <path
                                                            d="M7 18v-2.5m0 0V14c0-.471 0-.707.154-.854C7.308 13 7.555 13 8.05 13h.7c.725 0 1.313.56 1.313 1.25S9.475 15.5 8.75 15.5zM21 13h-1.312c-.825 0-1.238 0-1.494.244s-.256.637-.256 1.423v.833m0 2.5v-2.5m0 0h2.187m-4.375 0c0 1.38-1.175 2.5-2.625 2.5c-.327 0-.49 0-.613-.067c-.291-.16-.262-.485-.262-.766v-3.334c0-.281-.03-.606.262-.766c.122-.067.286-.067.613-.067c1.45 0 2.625 1.12 2.625 2.5" />
                                                        <path
                                                            d="M15 22h-4.273c-3.26 0-4.892 0-6.024-.798a4.1 4.1 0 0 1-.855-.805C3 19.331 3 17.797 3 14.727v-2.545c0-2.963 0-4.445.469-5.628c.754-1.903 2.348-3.403 4.37-4.113C9.095 2 10.668 2 13.818 2c1.798 0 2.698 0 3.416.252c1.155.406 2.066 1.263 2.497 2.35C20 5.278 20 6.125 20 7.818V10" />
                                                        <path
                                                            d="M3 12a3.333 3.333 0 0 1 3.333-3.333c.666 0 1.451.116 2.098-.057A1.67 1.67 0 0 0 9.61 7.43c.173-.647.057-1.432.057-2.098A3.333 3.333 0 0 1 13 2" />
                                                    </g>
                                                </svg>
                                            @break

                                            @case('doc' || 'docx')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                        <path
                                                            d="M21 14.016c-.046-.992-.723-1.016-1.643-1.016c-1.416 0-1.651.338-1.651 1.667v1.666c0 1.329.235 1.667 1.651 1.667c.92 0 1.597-.024 1.643-1.016M10.295 15.5c0 1.38-1.106 2.5-2.47 2.5c-.309 0-.463 0-.577-.067c-.275-.16-.247-.485-.247-.766v-3.334c0-.281-.028-.606.247-.766c.114-.067.268-.067.576-.067c1.365 0 2.47 1.12 2.47 2.5M14 18c-.776 0-1.165 0-1.406-.244s-.241-.637-.241-1.423v-1.666c0-.786 0-1.179.241-1.423S13.224 13 14 13s1.165 0 1.406.244s.241.637.241 1.423v1.666c0 .786 0 1.179-.241 1.423S14.776 18 14 18" />
                                                        <path
                                                            d="M15 22h-4.273c-3.26 0-4.892 0-6.024-.798a4.1 4.1 0 0 1-.855-.805C3 19.331 3 17.797 3 14.727v-2.545c0-2.963 0-4.445.469-5.628c.754-1.903 2.348-3.403 4.37-4.113C9.095 2 10.668 2 13.818 2c1.798 0 2.698 0 3.416.252c1.155.406 2.066 1.263 2.497 2.35C20 5.278 20 6.125 20 7.818V10" />
                                                        <path
                                                            d="M3 12a3.333 3.333 0 0 1 3.333-3.333c.666 0 1.451.116 2.098-.057A1.67 1.67 0 0 0 9.61 7.43c.173-.647.057-1.432.057-2.098A3.333 3.333 0 0 1 13 2" />
                                                    </g>
                                                </svg>
                                            @break

                                            @case('jpg' || 'png' || 'jpeg' || 'svg' || 'webp')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5" color="currentColor">
                                                        <path
                                                            d="M15 22h-4.273c-3.26 0-4.892 0-6.024-.798a4.1 4.1 0 0 1-.855-.805C3 19.331 3 17.797 3 14.727v-2.545c0-2.963 0-4.445.469-5.628c.754-1.903 2.348-3.403 4.37-4.113C9.095 2 10.668 2 13.818 2c1.798 0 2.698 0 3.416.252c1.155.406 2.066 1.263 2.497 2.35C20 5.278 20 6.125 20 7.818V10" />
                                                        <path
                                                            d="M3 12a3.333 3.333 0 0 1 3.333-3.333c.666 0 1.451.116 2.098-.057A1.67 1.67 0 0 0 9.61 7.43c.173-.647.057-1.432.057-2.098A3.333 3.333 0 0 1 13 2m-3 11v2.623c0 .901-.101 1.989-.952 2.289c-.636.224-1.412-.047-1.771-.618C7.108 17.026 7 16.736 7 16.5m5.5 1.5v-5h1.383c.694 0 1.448.34 1.525 1.03a1.7 1.7 0 0 1-.055.633c-.146.54-.703.837-1.262.837H13.5M21 14c-.052-.765-.378-.986-1.5-1h-1a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1H20a1 1 0 0 0 1-1v-.5a.5.5 0 0 0-.5-.5h-1" />
                                                    </g>
                                                </svg>
                                            @break

                                            @case('pptx')
                                                <svg xmlns="http://www.w3.org/2000/svg" width="256" height="256"
                                                    viewBox="0 0 256 256">
                                                    <path fill="currentColor"
                                                        d="M96 96H80a8 8 0 0 0-8 8v48a8 8 0 0 0 16 0v-8h8a24 24 0 0 0 0-48m0 32h-8v-16h8a8 8 0 0 1 0 16m40-104a104.33 104.33 0 0 0-82 40H40a16 16 0 0 0-16 16v96a16 16 0 0 0 16 16h14a104 104 0 1 0 82-168m87.63 96H160V80a16 16 0 0 0-16-16V40.37A88.13 88.13 0 0 1 223.63 120M128 40.37V64H75.63A88.36 88.36 0 0 1 128 40.37M40 80h104v47.9a.5.5 0 0 0 0 .2V176H40Zm88 112v23.63A88.36 88.36 0 0 1 75.63 192Zm16 23.63V192a16 16 0 0 0 16-16v-40h63.63A88.13 88.13 0 0 1 144 215.63" />
                                                </svg>
                                            @break

                                            @default
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" stroke="currentColor" stroke-width="2">
                                                        <path
                                                            d="M13.172 3H9c-1.886 0-2.828 0-3.414.586S5 5.114 5 7v10c0 1.886 0 2.828.586 3.414S7.114 21 9 21h6c1.886 0 2.828 0 3.414-.586S19 18.886 19 17V8.828c0-.408 0-.613-.076-.796s-.22-.329-.51-.618l-3.828-3.828c-.29-.29-.434-.434-.617-.51C13.785 3 13.58 3 13.172 3Z" />
                                                        <path d="M13 3v4c0 .943 0 1.414.293 1.707S14.057 9 15 9h4" />
                                                    </g>
                                                </svg>
                                        @endswitch
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
                                            <a href="{{ route('file_preview', [
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
