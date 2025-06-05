@extends('client.layouts.layout', [
    'indexMenu' => 4,
])

@push('styles')
    <style>
        * {
            box-sizing: border-box
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        .mySlides img {
            aspect-ratio: 16/9;
            object-fit: cover;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }
    </style>
@endpush

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
                    <p class="font-semibold text-[#dd326c] absolute top-0 left-[10px] translate-y-[-50%] bg-white px-1"> Sắp
                        xếp </p>
                    <select name="sort" id="" class="outline-0">
                        <option value="asc" {{ request()->sort == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                        <option value="desc" {{ request()->sort == 'desc' ? 'selected' : '' }}>Mới nhất</option>
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
                <a href="{{ route('document.create') }}"
                    class="bg-[#2563eb] w-fit flex justify-center items-center gap-2 rounded px-3 text-white transition-all active:scale-[1.1] my-5 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 448 512">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32" />
                    </svg>
                    <span>Thêm tài liệu</span>
                </a>
            @endrole
        </div>
    </section>
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            @foreach ($documents as $document)
                <div
                    class="bg-white relative rounded-xl shadow-md  border border-gray-200 hover:shadow-lg transition mb-6 ">

                    @role(99)
                        <div class="absolute right-0 top-0 translate-x-[-50%] translate-y-[50%]">
                            <button
                                class="delete-confirmation-button text-red-600 h-[50px] w-[50px] flex items-center justify-center hover:bg-red-100 rounded-full transition-all active:scale-[1.1] border-2 border-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1" />
                                </svg>
                            </button>

                            <div
                                class="absolute top-full right-0 border-2 border-gray-200 bg-white rounded-lg shadow-lg p-3 w-[500px] hidden delete-confirmation">
                                <form action="{{ route('document.destroy', $document->id) }}" class="" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                                    <p class="text-center font-bold">Bạn có chắc chắn muốn xoá tài liệu này?</p>
                                    <div class="flex gap-5 justify-center mt-3">

                                        <button type="button"
                                            class="text-gray-600 hover:bg-gray-100 rounded-lg px-3 py-1 transition-all active:scale-[1.1] cancel-delete">Huỷ</button>
                                        <button type="submit"
                                            class="text-red-600 hover:bg-red-100 rounded-lg px-3 py-1 transition-all active:scale-[1.1]">Xoá</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    @endrole
                    <div class="p-5 documents-container">
                        <div class="flex items-center mb-3">
                            <div class=" bg-blue-100 rounded-lg flex items-center justify-center mr-3 p-1">
                                <img src="{{ asset($document->thumbnail) }}" class="w-[80px] h-[80px] object-cover rounded"
                                    alt=""
                                    onerror="this.onerror=null; this.src='{{ asset('assets/images/failed.gif') }}';">
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">{{ $document->title }} - <span
                                        class="text-sm  text-gray-500 italic">Đăng tải lúc
                                        {{ $document->created_at }}</span></h3>
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
                            @foreach ($document->tags as $tag)
                                <p class=" text-sm py-1 px-4 font-bold my-2 bg-[#f39118] rounded text-white w-fit">
                                    #{{ $tag ?? '' }}</p>
                            @endforeach
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Bộ {{ count($document->documentFiles) }} file tài
                                liệu</span>
                            <div class="flex gap-2">

                                <div
                                    class="add-slide-container hidden fixed top-[50px] w-[800px] left-1/2 translate-x-[-50%] z-50 bg-white rounded-xl shadow-lg border border-gray-200 p-5">
                                    <h3 class="text-lg font-bold mb-4 text-center text-blue-700">Danh sách preview slide
                                    </h3>
                                    <div class="flex flex-col gap-4 max-h-[400px] overflow-y-auto">
                                        <!-- Danh sách ảnh preview, mỗi ảnh là 1 item -->
                                        <div
                                            class="flex items-center gap-3 border rounded-lg p-2 hover:bg-blue-50 transition preview-temp">
                                            <img src="${evt.target.result}" alt="Preview Slide"
                                                class="w-20 h-14 object-cover rounded shadow border border-gray-200 bg-gray-100">
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-700 truncate">${file.name}</p>
                                            </div>
                                        </div>
                                        <!-- ... Thêm nhiều ảnh khác nếu cần ... -->
                                    </div>
                                    <div class="mt-5">
                                        <label class="block">
                                            <span class="text-sm font-medium text-gray-700">Thêm ảnh preview mới</span>
                                            <input type="file" accept="image/*" multiple
                                                class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                        </label>
                                        <button
                                            class="mt-3 w-full bg-blue-600 text-white rounded px-4 py-2 hover:bg-blue-700 transition font-semibold">Tải
                                            lên</button>
                                    </div>
                                </div>

                                <button
                                    class="add-preview-slide px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-sm border-2 border-amber-600">Thêm
                                    preview slide</button>

                                <button
                                    class="show-full-documents px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-sm border-2 border-amber-600">Danh
                                    sách file</button>

                            </div>
                        </div>
                        <div class=" border-2 border-gray-200 rounded py-2 pl-5 my-2 documents-list hidden">

                            <div class="flex gap-2">

                                <div tab-id="images-container" class="flex-1 border-2 border-primary flex flex-col">
                                    <div class="flex-1">
                                        <div id="images-container">
                                            <div class="slideshow-container">
                                                <div class="mySlides fade">
                                                    <div class="numbertext"></div>
                                                    <img src="{{ asset('assets/images/failed.gif') }}"
                                                        style="width:100%">
                                                    <div class="text">abc</div>
                                                </div>
                                                <div class="mySlides fade">
                                                    <div class="numbertext"></div>
                                                    <img src="{{ asset('assets/images/panda.gif') }}" style="width:100%">
                                                    <div class="text">abc</div>
                                                </div>
                                                <div class="mySlides fade">
                                                    <div class="numbertext"></div>
                                                    <img src="{{ asset('assets/images/failed.gif') }}"
                                                        style="width:100%">
                                                    <div class="text">abc</div>
                                                </div>
                                                <div class="mySlides fade">
                                                    <div class="numbertext"></div>
                                                    <img src="{{ asset('assets/images/panda.gif') }}" style="width:100%">
                                                    <div class="text">abc</div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-center gap-2 m-[5px]">
                                        <div
                                            class="rotate-180 prev-btn hover:text-primary-500 cursor-pointer hover:scale-[110%] transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M21.409 9.353a2.998 2.998 0 0 1 0 5.294L8.597 21.614C6.534 22.737 4 21.277 4 18.968V5.033c0-2.31 2.534-3.769 4.597-2.648z" />
                                            </svg>
                                        </div>
                                        <button
                                            class="next-btn hover:text-primary-500 cursor-pointer hover:scale-[110%] transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M21.409 9.353a2.998 2.998 0 0 1 0 5.294L8.597 21.614C6.534 22.737 4 21.277 4 18.968V5.033c0-2.31 2.534-3.769 4.597-2.648z" />
                                            </svg>
                                        </button>

                                        <div class="flex flex-1 rounded overflow-hidden">
                                            <div role="button" class="dot flex-1 h-[20px] bg-amber-400"></div>
                                            <div role="button" class="dot flex-1 h-[20px]  bg-gray-400"></div>
                                            <div role="button" class="dot flex-1 h-[20px]  bg-gray-400"></div>
                                            <div role="button" class="dot flex-1 h-[20px] bg-gray-400"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    @foreach ($document->documentFiles as $file)
                                        <div
                                            class="text-sm text-blue-500 hover:bg-gray-100 p-1 flex items-center gap-2 justify-between relative">



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
                                                    <input type="hidden" name="file" value="{{ $file->file_path }}">
                                                    <button data-tippy-content="Tải về file này"
                                                        class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-sm"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24">
                                                            <g fill="none" stroke="currentColor"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2">
                                                                <path fill="currentColor" fill-opacity="0"
                                                                    stroke-dasharray="20" stroke-dashoffset="20"
                                                                    d="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5">
                                                                    <animate attributeName="d" begin="0.5s"
                                                                        dur="1.5s" repeatCount="indefinite"
                                                                        values="M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5;M12 4h2v3h2.5l-4.5 4.5M12 4h-2v3h-2.5l4.5 4.5;M12 4h2v6h2.5l-4.5 4.5M12 4h-2v6h-2.5l4.5 4.5" />
                                                                    <animate fill="freeze" attributeName="fill-opacity"
                                                                        begin="0.7s" dur="0.5s" values="0;1" />
                                                                    <animate fill="freeze"
                                                                        attributeName="stroke-dashoffset" dur="0.4s"
                                                                        values="20;0" />
                                                                </path>
                                                                <path stroke-dasharray="14" stroke-dashoffset="14"
                                                                    d="M6 19h12">
                                                                    <animate fill="freeze"
                                                                        attributeName="stroke-dashoffset" begin="0.5s"
                                                                        dur="0.2s" values="14;0" />
                                                                </path>
                                                            </g>
                                                        </svg></button>
                                                </form>

                                                <a data-tippy-content="Xoá file này"
                                                    href="{{ route('document.delete_file', $file->id) }}"
                                                    class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-sm">Xoá</a>

                                                @if (pathinfo($file->file_path, PATHINFO_EXTENSION) != 'zip')
                                                    <a data-tippy-content="Xem trước file này"
                                                        href="{{ route('file_preview', [
                                                            'fileName' => $file->file_path,
                                                        ]) }}"
                                                        target="_blank"
                                                        class="px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-sm">Đọc</a>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                    <form action="{{ route('document.add_file') }}" method="POST" class="form-add-file"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="flex gap-3">
                                            <button type="button"
                                                class="add-file-element px-3 my-3 py-1 bg-green-50 text-green-600 rounded-lg text-sm">Thêm
                                                file</button>
                                            <button type="submit"
                                                class="px-3 my-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-sm">Xác
                                                nhận</button>
                                        </div>
                                        <input type="text" name="document_id" value="{{ $document->id }}" hidden>

                                        <div class="flex gap-2">
                                            <label
                                                class="flex items-center gap-2 cursor-pointer bg-gray-100 hover:bg-gray-200 transition-all rounded-lg px-3 py-1 file-element mb-5">
                                                <input type="file" name="new_files[]" hidden {{-- show name file for class file-name --}}
                                                    onchange="
                                                    const fileName = this.files[0]?.name || 'Chọn file để tải lên';
                                                    this.closest('label').querySelector('.file-name').textContent = fileName;">
                                                <div
                                                    class="w-6 h-6 flex items-center justify-center rounded-full bg-white border-2 border-gray-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2">
                                                            <path fill="currentColor" fill-opacity="0"
                                                                stroke-dasharray="20" stroke-dashoffset="20"
                                                                d="M12 15h2v-6h2.5l-4.5 -4.5M12 15h-2v-6h-2.5l4.5 -4.5">
                                                                <animate attributeName="d" begin="0.5s" dur="1.5s"
                                                                    repeatCount="indefinite"
                                                                    values="M12 15h2v-6h2.5l-4.5 -4.5M12 15h-2v-6h-2.5l4.5 -4.5;M12 15h2v-3h2.5l-4.5 -4.5M12 15h-2v-3h-2.5l4.5 -4.5;M12 15h2v-6h2.5l-4.5 -4.5M12 15h-2v-6h-2.5l4.5 -4.5" />
                                                                <animate fill="freeze" attributeName="fill-opacity"
                                                                    begin="0.7s" dur="0.5s" values="0;1" />
                                                                <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                    dur="0.4s" values="20;0" />
                                                            </path>
                                                            <path stroke-dasharray="14" stroke-dashoffset="14"
                                                                d="M6 19h12">
                                                                <animate fill="freeze" attributeName="stroke-dashoffset"
                                                                    begin="0.5s" dur="0.2s" values="14;0" />
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <span class="text-sm text-gray-500 file-name">Chọn file để tải lên</span>
                                            </label>
                                            <input type="text" name="name[]"
                                                class="outline-0 w-full border-2 border-gray-200 rounded px-3 py-2 h-fit mr-3"
                                                placeholder="Tên file mới">
                                        </div>


                                    </form>
                                </div>
                            </div>

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

    <script>
        const deleteBtns = document.querySelectorAll('.delete-confirmation-button');
        deleteBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const confirmationBox = btn.nextElementSibling;
                confirmationBox.classList.toggle('hidden');
            })
        })
        const cancelDeleteBtns = document.querySelectorAll('.cancel-delete');
        cancelDeleteBtns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const confirmationBox = btn.closest('.delete-confirmation');
                confirmationBox.classList.add('hidden');
            })
        })
    </script>

    <script>
        const elementFile = `
        <div class="flex gap-2">
                                    <label class="flex items-center gap-2 cursor-pointer bg-gray-100 hover:bg-gray-200 transition-all rounded-lg px-3 py-1 file-element mb-5">
                                        <input type="file" name="new_files[]" hidden 
                                        {{-- show name file for class file-name --}}
                                        onchange="
                                            const fileName = this.files[0]?.name || 'Chọn file để tải lên';
                                            this.closest('label').querySelector('.file-name').textContent = fileName;"
                                        >
                                        <div class="w-6 h-6 flex items-center justify-center rounded-full bg-white border-2 border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path fill="currentColor" fill-opacity="0" stroke-dasharray="20" stroke-dashoffset="20" d="M12 15h2v-6h2.5l-4.5 -4.5M12 15h-2v-6h-2.5l4.5 -4.5"><animate attributeName="d" begin="0.5s" dur="1.5s" repeatCount="indefinite" values="M12 15h2v-6h2.5l-4.5 -4.5M12 15h-2v-6h-2.5l4.5 -4.5;M12 15h2v-3h2.5l-4.5 -4.5M12 15h-2v-3h-2.5l4.5 -4.5;M12 15h2v-6h2.5l-4.5 -4.5M12 15h-2v-6h-2.5l4.5 -4.5"/><animate fill="freeze" attributeName="fill-opacity" begin="0.7s" dur="0.5s" values="0;1"/><animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="20;0"/></path><path stroke-dasharray="14" stroke-dashoffset="14" d="M6 19h12"><animate fill="freeze" attributeName="stroke-dashoffset" begin="0.5s" dur="0.2s" values="14;0"/></path></g></svg>
                                        </div>
                                        <span class="text-sm text-gray-500 file-name">Chọn file để tải lên</span>
                                    </label>
                                    <input type="text" name="name[]" class="outline-0 w-full border-2 border-gray-200 rounded px-3 py-2 h-fit mr-3" placeholder="Tên file mới">
                                </div>
        `

        const addFileBtns = document.querySelectorAll('.add-file-element');
        addFileBtns.forEach((btn) => {
            btn.addEventListener('click', () => {
                btn.closest('.form-add-file').insertAdjacentHTML('beforeend', elementFile);
            })
        })
    </script>

    <script>
        const slideShowContainers = document.querySelectorAll('.slideshow-container');
        const slideIndexs = Array(slideShowContainers.length).fill(1);

        slideShowContainers.forEach(function(slideShowContainer, index) {
            const slideShowContainerWrapper = slideShowContainer.closest('[tab-id]');

            showSlides(slideIndexs[index]);

            // Next/previous controls
            function plusSlides(n) {
                showSlides(slideIndexs[index] += n);
            }

            // Thumbnail image controls
            function currentSlide(n) {
                showSlides(slideIndexs[index] = n);
            }

            function showSlides(n) {
                let i;
                let slides = slideShowContainerWrapper.getElementsByClassName("mySlides");
                let dots = slideShowContainerWrapper.getElementsByClassName("dot");
                let nextBtn = slideShowContainerWrapper.querySelector('.next-btn');
                let prevBtn = slideShowContainerWrapper.querySelector('.prev-btn');

                if (slides.length === 0) return;

                if (n > slides.length) {
                    slideIndexs[index] = 1;
                }
                if (n < 1) {
                    slideIndexs[index] = slides.length;
                }

                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }

                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className
                        .replace(" active", "")
                        .replace(" bg-amber-500", "")
                        .replace(" bg-gray-300", "");

                    if (
                        i === 0 || // luôn tô màu dot đầu tiên
                        (i < slideIndexs[index]) || // các dot trước slide hiện tại
                        (i === dots.length - 1 && slideIndexs[index] === dots.length) // dot cuối khi ở slide cuối
                    ) {
                        dots[i].className += " bg-amber-500";
                    } else {
                        dots[i].className += " bg-gray-300";
                    }
                }

                slides[slideIndexs[index] - 1].style.display = "block";
                if (dots[slideIndexs[index] - 1]) {
                    dots[slideIndexs[index] - 1].className += " active";
                }
            }

            // Đảm bảo chỉ gán sự kiện 1 lần
            const nextBtn = slideShowContainerWrapper.querySelector('.next-btn');
            const prevBtn = slideShowContainerWrapper.querySelector('.prev-btn');
            if (nextBtn) nextBtn.onclick = () => plusSlides(1);
            if (prevBtn) prevBtn.onclick = () => plusSlides(-1);

            const dots = slideShowContainerWrapper.getElementsByClassName("dot");
            Array.from(dots).forEach((dot, dotIdx) => {
                dot.onclick = () => currentSlide(dotIdx + 1);
            });

            setInterval(() => {
                nextBtn.click();
            }, 30000);
        });
    </script>

    <script>
        const addSlideBtns = document.querySelectorAll('.add-preview-slide');
        console.log(addSlideBtns);

        addSlideBtns.forEach(function(btn) {
            btn.onclick = function() {
                var addSlideContainer = btn.closest('div').querySelector('.add-slide-container');
                addSlideContainer.classList.toggle('hidden')
            }
        })
    </script>
    <script>
        document.querySelectorAll('.add-slide-container input[type="file"]').forEach(function(input) {
            input.addEventListener('change', function(e) {
                const previewList = input.closest('.add-slide-container').querySelector(
                    '.flex.flex-col.gap-4');
                // Xoá các preview cũ vừa chọn (nếu muốn giữ ảnh cũ thì bỏ dòng này)
                previewList.querySelectorAll('.preview-temp').forEach(el => el.remove());

                Array.from(input.files).forEach(file => {
                    if (!file.type.startsWith('image/')) return;
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        // Tạo phần tử preview
                        const div = document.createElement('div');
                        div.className =
                            "flex items-center gap-3 border rounded-lg p-2 hover:bg-blue-50 transition preview-temp";
                        div.innerHTML = `
                            <img src="${evt.target.result}" alt="Preview Slide"
                            class="w-20 h-14 object-cover rounded shadow border border-gray-200 bg-gray-100">
                        <div class="flex-1">
                            <p class="text-sm text-gray-700 truncate">${file.name}</p>
                        </div>
                   
                    `;
                        // Thêm vào đầu danh sách preview
                        previewList.prepend(div);

                        // Xoá preview tạm nếu bấm nút Xoá
                        div.querySelector('.remove-preview-temp').onclick = () => div.remove();
                    };
                    reader.readAsDataURL(file);
                });
            });
        });
    </script>
@endpush
