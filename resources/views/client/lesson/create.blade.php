@extends('client.layouts.layout', [
    'indexMenu' => 2,
])
@push('styles')
    <style type="text/css">
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

        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
        }

        .video-container iframe,
        .video-container video,
        .video-container .plyr {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 1rem;
        }

        .plyr--full-ui input[type=range] {
            color: #ec4899 !important;
            /* primary-500 */
        }

        .plyr__control--overlaid {
            background: rgba(236, 72, 153, 0.8) !important;
            /* primary-500 với độ trong suốt */
        }

        .plyr--video .plyr__control:hover {
            background: #ec4899 !important;
            /* primary-500 */
        }

        .plyr--video .plyr__control.plyr__tab-focus,
        .plyr__menu__container .plyr__control[role=menuitemradio][aria-checked=true]::before {
            background: #ec4899 !important;
            /* primary-500 */
        }

        .drag-drop-zone {
            border: 2px dashed #e5e7eb;
            transition: all 0.3s ease;
        }

        .drag-drop-zone:hover,
        .drag-drop-zone.active {
            border-color: #ec4899;
            background-color: #fdf2f8;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .quiz-option {
            transition: all 0.3s ease;
        }

        .quiz-option:hover {
            transform: translateY(-2px);
        }

        .editor-toolbar button {
            @apply p-2 text-gray-600 hover:text-primary-600 hover:bg-primary-50 rounded;
        }

        .editor-toolbar button.active {
            @apply bg-primary-100 text-primary-600;
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
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Tạo Bài Học Mới</h1>
                    <p class="text-lg text-white text-stroke-3">Tạo bài học hấp dẫn và tương tác cho học sinh của bạn!</p>
                </div>
                <div class="md:w-1/3 flex justify-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2232/2232688.png" alt="Create Lesson"
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

    <!-- Main Content -->
    <form class="container mx-auto px-4 sm:px-6 lg:px-8 py-8" enctype="multipart/form-data" method="POST"
        action="{{ route('lession.store') }}">
        @csrf
        <!-- Tabs Navigation -->
        <div class="mb-8">
            <div class="flex flex-wrap border-b border-gray-200">
                <button type="button"
                    class="tab-button px-6 py-3 font-bold text-primary-600 border-b-2 border-primary-500 -mb-px"
                    data-tab="basic-info">
                    <i class="fas fa-info-circle mr-2"></i>Thông tin cơ bản
                </button>
                <button type="button" class="tab-button px-6 py-3 font-bold text-gray-500 hover:text-gray-700"
                    data-tab="video-upload">
                    <i class="fas fa-video mr-2"></i>Video bài giảng
                </button>
                <button type="button" class="tab-button px-6 py-3 font-bold text-gray-500 hover:text-gray-700"
                    data-tab="resources">
                    <i class="fas fa-file-alt mr-2"></i>Tài liệu bổ sung
                </button>
                <button type="button" class="tab-button px-6 py-3 font-bold text-gray-500 hover:text-gray-700"
                    data-tab="quiz">
                    <i class="fas fa-question-circle mr-2"></i>Bài kiểm tra
                </button>
                <button type="button" class="tab-button px-6 py-3 font-bold text-gray-500 hover:text-gray-700"
                    data-tab="publish">
                    <i class="fas fa-upload mr-2"></i>Xuất bản
                </button>
            </div>
        </div>
        <!-- Tab Content -->
        <div class="tab-content active" id="basic-info">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Thông tin cơ bản</h2>

                <div class="space-y-6">
                    <div>
                        <label for="lesson_type_id" class="block text-lg font-bold text-gray-700 mb-2">Chọn serie (chương)
                            môn học <span class="text-red-500">*</span></label>
                        <input type="text" hidden value="{{ request('lesson_type_id') }}" name="lesson_type_id">
                        <select id="lesson_type_id" name="lesson_type_id" disabled
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                            @foreach ($lessonTypes as $lt)
                                <option value="{{ $lt->id }}"
                                    {{ $lessonType?->id ?? 0 == $lt->id ? 'selected' : '' }}>
                                    {{ $lt->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="lesson_type_id" value="{{ request('lesson_type_id') }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="lesson-subject" class="block text-lg font-bold text-gray-700 mb-2">Môn học <span
                                    class="text-red-500">*</span></label>
                            <select id="lesson-subject" name="subject_id" disabled
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                <option value="">Chọn môn học</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="lesson-grade" class="block text-lg font-bold text-gray-700 mb-2">Lớp <span
                                    class="text-red-500">*</span></label>
                            <select id="lesson-grade" name="class_id" disabled
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"> {{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="h-[5px] w-full bg-primary-500"></div>
                    <div required-value>
                        <label for="lesson-title" class="block text-lg font-bold text-gray-700 mb-2">Tiêu đề bài học <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="lesson-title" name="title" required
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                            placeholder="Nhập tiêu đề bài học" value="Phép cộng và trừ trong phạm vi 100">
                    </div>

                    <div required-value>
                        <label for="lesson-description" class="block text-lg font-bold text-gray-700 mb-2">Mô tả bài học
                            <span class="text-red-500">*</span></label>
                        <textarea id="lesson-description" name="description" rows="4"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                            placeholder="Mô tả ngắn về bài học">Học cách thực hiện phép cộng và trừ với các số trong phạm vi 100, bao gồm cả phép cộng có nhớ và phép trừ có mượn.</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div required-value>
                            <label for="lesson-duration" class="block text-lg font-bold text-gray-700 mb-2">Thời lượng
                                (phút) <span class="text-red-500">*</span></label>
                            <input type="number" id="lesson-duration" name="duration" min="1"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                placeholder="Nhập thời lượng bài học" value="20">
                        </div>

                        <div required-value>
                            <label for="lesson-difficulty" class="block text-lg font-bold text-gray-700 mb-2">Độ
                                khó</label>
                            <select id="lesson-difficulty" name="level"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                <option value="1">Dễ</option>
                                <option value="2" selected>Trung bình</option>
                                <option value="3">Khó</option>
                            </select>
                        </div>
                    </div>

                    <div required-value>
                        <label for="lesson-thumbnail" class="block text-lg font-bold text-gray-700 mb-2">Ảnh thu
                            nhỏ</label>
                        <div class="flex items-center">
                            <div
                                class="w-32 h-24 bg-gray-100 rounded-xl flex items-center justify-center mr-4 overflow-hidden">
                                <img id="thumbnail-preview"
                                    src="https://img.freepik.com/free-vector/hand-drawn-colorful-math-background_23-2148157266.jpg"
                                    alt="Thumbnail Preview" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <label
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                                    <i class="fas fa-upload mr-2"></i>
                                    Tải lên ảnh
                                    <input type="file" id="lesson-thumbnail" name="thumbnail" class="hidden"
                                        accept="image/*">
                                </label>
                                <p class="text-sm text-gray-500 mt-1">PNG, JPG hoặc GIF (tối đa 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-lg font-bold text-gray-700 mb-2">Thẻ (Tags)</label>
                        <div class="flex flex-wrap gap-2 mb-2">
                            <span
                                class="bg-primary-100 text-primary-800 text-sm font-bold px-3 py-1 rounded-full flex items-center">
                                Toán học
                                <button class="ml-2 text-primary-600 hover:text-primary-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </span>
                            <span
                                class="bg-primary-100 text-primary-800 text-sm font-bold px-3 py-1 rounded-full flex items-center">
                                Lớp 2
                                <button class="ml-2 text-primary-600 hover:text-primary-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </span>
                            <span
                                class="bg-primary-100 text-primary-800 text-sm font-bold px-3 py-1 rounded-full flex items-center">
                                Phép cộng
                                <button class="ml-2 text-primary-600 hover:text-primary-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </span>
                            <span
                                class="bg-primary-100 text-primary-800 text-sm font-bold px-3 py-1 rounded-full flex items-center">
                                Phép trừ
                                <button class="ml-2 text-primary-600 hover:text-primary-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </span>
                        </div>
                        <input type="text" name="tags" hidden>
                        <div class="flex gap-2 items-center">
                            <input id="input-add-tag" type="text" placeholder="Thêm thẻ mới"
                                class="px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                            <button id="button-add-tag" type="button"
                                class=" text-primary-600 hover:text-primary-800 px-4 h-full">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label for="lesson-objectives" class="block text-lg font-bold text-gray-700 mb-2">Mục tiêu bài
                            học</label>
                        <textarea id="lesson-objectives" name="objectives" rows="4"
                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                            placeholder="Nhập mục tiêu bài học">- Học sinh hiểu và thực hiện được phép cộng trong phạm vi 100
- Học sinh hiểu và thực hiện được phép trừ trong phạm vi 100
- Học sinh vận dụng được phép cộng, trừ để giải quyết các bài toán đơn giản</textarea>
                    </div>
                    <div>
                        <label for="lesson-content" class="block text-lg font-bold text-gray-700 mb-2">Nội dung bài
                            học</label>
                        <div class="border-2 border-gray-200 rounded-xl overflow-hidden">

                            <textarea id="lesson-content" name="content" rows="10"
                                class="w-full px-4 py-3 border-0 focus:outline-none text-lg" placeholder="Nhập nội dung chi tiết của bài học"></textarea>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">Sử dụng Markdown để định dạng văn bản. Hỗ trợ tiêu đề, danh
                            sách, bảng, hình ảnh, v.v.</p>
                    </div>


                </div>

                <div class="flex justify-end mt-8">
                    <button type="button"
                        class="next-tab px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700"
                        data-next="video-upload">
                        Tiếp theo: Video bài giảng
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content" id="video-upload">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Bài giảng</h2>
                <div class="p-5 m-5 border-2 border-dashed relative border-primary-500 mb-[50px]">
                    <p class="absolute top-0 translate-y-[-50%] left-[20px] bg-white px-2 mb-5 font-bold text-primary-500">File zip cho bài giảng</p>
                    <input type="text" name="zip_title"
                        class="w-full px-4 py-3 mb-4 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                        placeholder="Tiêu đề bài giảng">
                    <div class="drag-drop-zone rounded-xl p-8 text-center cursor-pointer">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                        </div>
                        <h3 id="heading-video" class="text-xl font-bold text-gray-700 mb-2">Nhập file zip vào đây</h3>
                        <p class="text-gray-500 mb-4">hoặc</p>
                        <label
                            class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                            <i class="fas fa-upload mr-2"></i>
                            Chọn file zip từ máy tính
                            <input type="file" id="video-upload" name="zip_path" class="hidden"
                                accept=".zip">
                        </label>
                        <p class="text-sm text-gray-500 mt-4">Hỗ trợ: <span class="font-bold text-red-500">Zip</span>
                            </p>
                    </div>
                
                </div>

                <div class="p-5 m-5 border-2 border-dashed relative border-green-500 mb-[50px]">
                    <p class="absolute top-0 translate-y-[-50%] left-[20px] bg-white px-2 mb-5 font-bold text-green-500">File video cho bài giảng</p>
                    <input type="text" name="video_title"
                        class="w-full px-4 py-3 mb-4 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                        placeholder="Tiêu đề video">
                    <div class="drag-drop-zone rounded-xl p-8 text-center cursor-pointer">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                        </div>
                        <h3 id="heading-video" class="text-xl font-bold text-gray-700 mb-2">Nhập file video vào đây</h3>
                        <p class="text-gray-500 mb-4">hoặc</p>
                        <label
                            class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-bold rounded-xl cursor-pointer hover:bg-green-700">
                            <i class="fas fa-upload mr-2"></i>
                            Chọn video từ máy tính
                            <input type="file" id="video-upload" name="video_path" class="hidden"
                                accept=".mp4,video/mp4">
                        </label>
                        <p class="text-sm text-gray-500 mt-4">Hỗ trợ: <span class="font-bold text-red-500">MP4</span>
                            </p>
                    </div>
                
                </div>


                <div class="p-5 m-5 border-2 border-dashed relative border-purple-500 mb-[50px]">
                    <p class="absolute top-0 translate-y-[-50%] left-[20px] bg-white px-2 mb-5 font-bold text-purple-500">File ảnh cho bài giảng</p>
                    <input type="text" name="images_title"
                        class="w-full px-4 py-3 mb-4 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                        placeholder="Tiêu đề ảnh">
                    <div class="drag-drop-zone rounded-xl p-8 text-center cursor-pointer">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400"></i>
                        </div>
                        <h3 id="heading-video" class="text-xl font-bold text-gray-700 mb-2">Nhập ảnh vào đây</h3>
                        <p class="text-gray-500 mb-4">hoặc</p>
                        <label
                            class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-bold rounded-xl cursor-pointer hover:bg-purple-700">
                            <i class="fas fa-upload mr-2"></i>
                            Chọn ảnh từ máy tính
                            <input type="file" id="video-upload" name="image_paths[]" multiple class="hidden"
                                accept="image/*">
                        </label>
                        <p class="text-sm text-gray-500 mt-4">Hỗ trợ: <span class="font-bold text-red-500">JPG, PNG, JPEG, GIF</span>
                            </p>
                    </div>
                
                </div>


            

                <div class="flex justify-between mt-8">
                    <button type="button"
                        class="prev-tab px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300"
                        data-prev="basic-info">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Quay lại
                    </button>
                    <button type="button"
                        class="next-tab px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700"
                        data-next="resources">
                        Tiếp theo: Tài liệu bổ sung
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content" id="resources">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Tài liệu bổ sung</h2>

                <div id="documents-container" class="space-y-6">
                    <div class="border-2 border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tài liệu 1</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label for="resource-title-1" class="block text-lg font-bold text-gray-700 mb-2">Tiêu đề
                                    tài liệu</label>
                                <input type="text" id="resource-title-1" name="resource_title[]"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Nhập tiêu đề tài liệu"
                                    value="Bài giảng Toán lớp 2: Phép cộng và trừ trong phạm vi 100">
                            </div>

                            <div>
                                <label for="resource-type-1" class="block text-lg font-bold text-gray-700 mb-2">Loại tài
                                    liệu </label>
                                <select id="resource-type-1" name="resource_type[]"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                    <option value="pdf" selected>PDF</option>
                                    <option value="doc">Word Document</option>
                                    <option value="ppt">PowerPoint</option>
                                    <option value="bg">Bài giảng</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="resource-description-1" class="block text-lg font-bold text-gray-700 mb-2">Mô tả
                                tài liệu</label>
                            <textarea id="resource-description-1" name="resource_description[]" rows="2"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                placeholder="Mô tả ngắn về tài liệu">Tài liệu hướng dẫn học sinh lớp 2 thực hiện các phép tính cộng và trừ trong phạm vi 100.</textarea>
                        </div>

                        <div class="drag-drop-zone rounded-xl p-6 text-center cursor-pointer">
                            <div class="mb-3">
                                <i class="fas fa-file text-4xl text-red-500"></i>
                            </div>
                            <h4 class="file-heading text-lg font-bold text-gray-700 mb-2">Kéo và thả tài liệu vào đây</h4>
                            <p class="text-gray-500 mb-3">hoặc</p>
                            <label
                                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                                <i class="fas fa-upload mr-2"></i>
                                Chọn tài liệu
                                <input type="file" id="resource-file-1" name="resource_file[]" class="hidden">
                            </label>
                            <p class="text-sm text-gray-500 mt-3">Hỗ trợ: PDF, ZIP, DOC, DOCX, PPT, PPTX, v..v...</p>
                        </div>


                    </div>

                    <div class="border-2 border-gray-200 rounded-xl p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Tài liệu 2</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label for="resource-title-2" class="block text-lg font-bold text-gray-700 mb-2">Tiêu đề
                                    tài liệu </label>
                                <input type="text" id="resource-title-2" name="resource_title[]"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Nhập tiêu đề tài liệu" value="Bài tập thực hành: Phép cộng và trừ">
                            </div>

                            <div>
                                <label for="resource-type-2" class="block text-lg font-bold text-gray-700 mb-2">Loại tài
                                    liệu </label>
                                <select id="resource-type-2" name="resource_type[]"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                    <option value="pdf" selected>PDF</option>
                                    <option value="doc">Word Document</option>
                                    <option value="ppt">PowerPoint</option>
                                    <option value="bg">Bài giảng</option>

                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="resource-description-2" class="block text-lg font-bold text-gray-700 mb-2">Mô tả
                                tài liệu</label>
                            <textarea id="resource-description-2" name="resource_description[]" rows="2"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                placeholder="Mô tả ngắn về tài liệu">Bài tập thực hành về phép cộng và trừ trong phạm vi 100 cho học sinh lớp 2.</textarea>
                        </div>

                        <div class="drag-drop-zone rounded-xl p-6 text-center cursor-pointer">
                            <div class="mb-3">
                                <i class="fas fa-file text-4xl text-red-500"></i>
                            </div>
                            <h4 class="file-heading text-lg font-bold text-gray-700 mb-2">Kéo và thả tài liệu vào đây</h4>
                            <p class="text-gray-500 mb-3">hoặc</p>
                            <label
                                class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                                <i class="fas fa-upload mr-2"></i>
                                Chọn tài liệu
                                <input type="file" id="resource-file-2" name="resource_file[]" class="hidden">
                            </label>
                            <p class="text-sm text-gray-500 mt-3">Hỗ trợ: PDF, ZIP, DOC, DOCX, PPT, PPTX, v.v.</p>
                        </div>
                    </div>


                </div>
                <div class="flex justify-end">
                    <button type="button" id="add-a-document-btn"
                        class="next-tab px-6 py-3 bg-purple-600 text-white font-bold rounded-xl hover:bg-primary-700"> Thêm
                        tài liệu</button>

                </div>
                <div class="flex justify-between mt-8">
                    <button class="prev-tab px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300"
                        data-prev="video-upload" type="button">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Quay lại
                    </button>
                    <button class="next-tab px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700"
                        data-next="quiz" type="button">
                        Tiếp theo: Bài kiểm tra
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="tab-content" id="quiz">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Bài kiểm tra</h2>

                <div class="space-y-6">
                    @for ($set = 1; $set <= 3; $set++)
                        <div class="border-2 border-gray-200 rounded-xl p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Bài kiểm tra {{ $set }}: Phép cộng và
                                trừ cơ bản</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                <div required-value>
                                    <label for="quiz-title-1" class="block text-lg font-bold text-gray-700 mb-2">Tiêu đề
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" id="quiz-title-1" name="set_title[{{ $set }}]"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                        placeholder="Nhập tiêu đề bài kiểm tra" value="Phép cộng và trừ cơ bản">
                                </div>

                                <div>
                                    <label for="quiz-difficulty-1" class="block text-lg font-bold text-gray-700 mb-2">Độ
                                        khó
                                    </label>
                                    <select id="quiz-difficulty-1" name="set_difficulty[{{ $set }}]"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        @switch($set)
                                            @case(1)
                                                <option value="1" selected>Dễ</option>
                                            @break

                                            @case(2)
                                                <option value="2" selected>Trung bình</option>
                                            @break

                                            @case(3)
                                                <option value="3" selected>Khó</option>
                                            @break

                                            @default
                                        @endswitch
                                    </select>
                                </div>


                            </div>

                            <div class="mb-6">
                                <label for="quiz-description-1" class="block text-lg font-bold text-gray-700 mb-2">Mô
                                    tả</label>
                                <textarea id="quiz-description-1" name="set_description[{{ $set }}]" rows="2"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Mô tả ngắn về bài kiểm tra">Kiểm tra kiến thức về phép cộng và trừ không nhớ, không mượn trong phạm vi 100.</textarea>
                            </div>



                            <!-- Question  -->
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="border-2 border-gray-100 rounded-xl p-4 mb-4 question-container">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-bold text-gray-900">Câu hỏi {{ $i }}</h4>
                                        <button type="button"
                                            class="show-hide transition-all px-5 py-2 bg-amber-600 rounded-lg text-white border-1">
                                            <svg class="transition-all" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd"><path d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z"/><path fill="currentColor" d="M13.06 16.06a1.5 1.5 0 0 1-2.12 0l-5.658-5.656a1.5 1.5 0 1 1 2.122-2.121L12 12.879l4.596-4.596a1.5 1.5 0 0 1 2.122 2.12l-5.657 5.658Z"/></g></svg>
                                        </button>
                                    </div>

                                    <div class="mb-4 question-content" required-value>
                                        <label for="question-text-1-1"
                                            class="block text-lg font-bold text-gray-700 mb-2">Nội
                                            dung
                                            câu hỏi <span class="text-red-500">*</span></label>
                                        <input type="text" id="question-text-1-1"
                                            name="set_quesion[{{ $set }}][{{ $i }}]"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                            placeholder="Nhập nội dung câu hỏi" value="Tính: 25 + 43 = ?">
                                    </div>

                                    <div class="mb-4 question-content" required-value>
                                        <label class="block text-lg font-bold text-gray-700 mb-2">Đáp án <span
                                                class="text-red-500">*</span></label>

                                        <div class="space-y-3">
                                            <div class="flex items-center quiz-option">
                                                <input type="radio" id="option-1-1-1"
                                                    name="set_answer_true[{{ $set }}][{{ $i }}]"
                                                    value="a" checked
                                                    class="w-5 h-5 text-primary-600 true-answer border-gray-300 focus:ring-primary-500 mr-2">
                                                <input type="text"
                                                    name="set_answer[{{ $set }}][{{ $i }}][a]"
                                                    class="flex-1 px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                    placeholder="Nhập đáp án A" value="58">
                                                <label for="option-1-1-1"
                                                    class="ml-2 text-gray-500 font-bold cursor-pointer">
                                                    Đúng
                                                </label>
                                            </div>

                                            <div class="flex items-center quiz-option">
                                                <input type="radio" id="option-1-1-2"
                                                    name="set_answer_true[{{ $set }}][{{ $i }}]"
                                                    value="b"
                                                    class="w-5 h-5 text-primary-600 true-answer border-gray-300 focus:ring-primary-500 mr-2">
                                                <input type="text"
                                                    name="set_answer[{{ $set }}][{{ $i }}][b]"
                                                    class="flex-1 px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                    placeholder="Nhập đáp án B" value="68">
                                                <label for="option-1-1-2"
                                                    class="ml-2 text-gray-500 font-bold cursor-pointer">
                                                    Đúng
                                                </label>
                                            </div>

                                            <div class="flex items-center quiz-option">
                                                <input type="radio" id="option-1-1-3"
                                                    name="set_answer_true[{{ $set }}][{{ $i }}]"
                                                    value="c"
                                                    class="w-5 h-5 text-primary-600 true-answer border-gray-300 focus:ring-primary-500 mr-2">
                                                <input type="text"
                                                    name="set_answer[{{ $set }}][{{ $i }}][c]"
                                                    class="flex-1 px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                    placeholder="Nhập đáp án C" value="78">
                                                <label for="option-1-1-3"
                                                    class="ml-2 text-gray-500 font-bold cursor-pointer">
                                                    Đúng
                                                </label>
                                            </div>

                                            <div class="flex items-center quiz-option">
                                                <input type="radio" id="option-1-1-4"
                                                    name="set_answer_true[{{ $set }}][{{ $i }}]"
                                                    value="d"
                                                    class="w-5 h-5 text-primary-600 true-answer border-gray-300 focus:ring-primary-500 mr-2">
                                                <input type="text"
                                                    name="set_answer[{{ $set }}][{{ $i }}][d]"
                                                    class="flex-1 px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                                    placeholder="Nhập đáp án D" value="88">
                                                <label for="option-1-1-4"
                                                    class="ml-2 text-gray-500 font-bold cursor-pointer">
                                                    Đúng
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" question-content" required-value>
                                        <label for="explanation-1-1"
                                            class="block text-lg font-bold text-gray-700 mb-2">Giải
                                            thích
                                            đáp án</label>
                                        <textarea id="explanation-1-1" name="set_explain_answer[{{ $set }}][{{ $i }}]" rows="2"
                                            class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                            placeholder="Giải thích đáp án đúng">25 + 43 = 68 (Sai)
25 + 43 = 5 + 20 + 3 + 40 = 5 + 3 + 20 + 40 = 8 + 60 = 68 (Đúng)</textarea>
                                    </div>
                                </div>
                            @endfor
                    @endfor


                    <div class="flex justify-between mt-8">
                        <button class="prev-tab px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300"
                            data-prev="resources" type="button">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Quay lại
                        </button>
                        <button
                            class="next-tab px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700"
                            data-next="publish" id="push-lession">
                            Tiếp theo: Xuất bản
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>


        </div>

        <div class="tab-content" id="publish">

            <div class="bg-white rounded-2xl shadow-md overflow-hidden p-6 mb-8">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center">
                        <i class="fas fa-spinner fa-spin text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Đang xuất bản bài học...</h3>
                        <p class="text-gray-700">Bài học của bạn đang được xuất bản. Vui lòng chờ trong giây lát.</p>
                    </div>
                </div>
            </div>
        </div>

        </main>
    @endsection
    @push('scripts')
        <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Khởi tạo Plyr
                const player = new Plyr('#player', {
                    controls: [
                        'play-large', 'restart', 'play', 'progress', 'current-time',
                        'duration', 'mute', 'volume', 'captions', 'settings', 'pip',
                        'airplay', 'fullscreen'
                    ]
                });

                // Tab Navigation
                const tabButtons = document.querySelectorAll('.tab-button');
                const tabContents = document.querySelectorAll('.tab-content');

                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const tabId = this.getAttribute('data-tab');

                        // Remove active class from all buttons and contents
                        tabButtons.forEach(btn => btn.classList.remove('text-primary-600', 'border-b-2',
                            'border-primary-500', '-mb-px'));
                        tabButtons.forEach(btn => btn.classList.add('text-gray-500',
                            'hover:text-gray-700'));
                        tabContents.forEach(content => content.classList.remove('active'));

                        // Add active class to current button and content
                        this.classList.add('text-primary-600', 'border-b-2', 'border-primary-500',
                            '-mb-px');
                        this.classList.remove('text-gray-500', 'hover:text-gray-700');
                        document.getElementById(tabId).classList.add('active');
                    });
                });

                // Next and Previous Tab Navigation
                const nextTabButtons = document.querySelectorAll('.next-tab');
                const prevTabButtons = document.querySelectorAll('.prev-tab');

                nextTabButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const nextTabId = this.getAttribute('data-next');
                        const nextTabButton = document.querySelector(
                            `.tab-button[data-tab="${nextTabId}"]`);
                        nextTabButton.click();
                    });
                });

                prevTabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const prevTabId = this.getAttribute('data-prev');
                        const prevTabButton = document.querySelector(
                            `.tab-button[data-tab="${prevTabId}"]`);
                        prevTabButton.click();
                    });
                });

                // Thumbnail Preview
                const thumbnailInput = document.getElementById('lesson-thumbnail');
                const thumbnailPreview = document.getElementById('thumbnail-preview');

                if (thumbnailInput && thumbnailPreview) {
                    thumbnailInput.addEventListener('change', function(e) {
                        if (e.target.files.length > 0) {
                            const file = e.target.files[0];
                            const reader = new FileReader();

                            reader.onload = function(e) {
                                thumbnailPreview.src = e.target.result;
                            };

                            reader.readAsDataURL(file);
                        }
                    });
                }

                // Drag and Drop Zones
                const dragDropZones = document.querySelectorAll('.drag-drop-zone');

                dragDropZones.forEach(zone => {
                    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                        zone.addEventListener(eventName, preventDefaults, false);
                    });

                    function preventDefaults(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    ['dragenter', 'dragover'].forEach(eventName => {
                        zone.addEventListener(eventName, highlight, false);
                    });

                    ['dragleave', 'drop'].forEach(eventName => {
                        zone.addEventListener(eventName, unhighlight, false);
                    });

                    function highlight() {
                        zone.classList.add('active');
                    }

                    function unhighlight() {
                        zone.classList.remove('active');
                    }
                });

                // Add Question Button Dropdown
                const addQuestionBtn = document.getElementById('add-question-btn');
                const questionTypeDropdown = document.getElementById('question-type-dropdown');

                if (addQuestionBtn && questionTypeDropdown) {
                    addQuestionBtn.addEventListener('click', function() {
                        questionTypeDropdown.classList.toggle('hidden');
                    });

                    // Close dropdown when clicking outside
                    document.addEventListener('click', function(e) {
                        if (!addQuestionBtn.contains(e.target) && !questionTypeDropdown.contains(e.target)) {
                            questionTypeDropdown.classList.add('hidden');
                        }
                    });
                }

                // Text Editor Toolbar
                const editorButtons = document.querySelectorAll('.editor-toolbar button');

                if (editorButtons.length > 0) {
                    editorButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Toggle active state for formatting buttons
                            if (!this.classList.contains('active')) {
                                // For buttons like bold, italic, etc. that can be toggled
                                if (['fa-bold', 'fa-italic', 'fa-underline'].some(cls => this
                                        .querySelector('i').classList.contains(cls))) {
                                    this.classList.toggle('active');
                                }
                                // For paragraph style buttons, deactivate others first
                                else if (['fa-paragraph', 'fa-heading'].some(cls => this.querySelector(
                                        'i').classList.contains(cls))) {
                                    document.querySelectorAll(
                                            '.editor-toolbar button i.fa-paragraph, .editor-toolbar button i.fa-heading'
                                        )
                                        .forEach(icon => icon.parentElement.classList.remove('active'));
                                    this.classList.add('active');
                                }
                            } else {
                                // Don't deactivate paragraph and heading buttons when already active
                                if (!['fa-paragraph', 'fa-heading'].some(cls => this.querySelector('i')
                                        .classList.contains(cls))) {
                                    this.classList.remove('active');
                                }
                            }
                        });
                    });
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const inputTags = document.querySelector('input[name="tags"]');
                const inputAddTag = document.getElementById('input-add-tag');
                const buttonAddTag = document.getElementById('button-add-tag');
                const tagContainer = document.querySelector('.flex.flex-wrap.gap-2.mb-2');

                // Khởi tạo tags từ input ẩn
                function initializeTags() {
                    tagContainer.innerHTML = '';
                    if (inputTags.value) {
                        const tags = inputTags.value.split(',');
                        tags.forEach(tag => createTagElement(tag.trim()));
                    }
                }

                // Tạo element hiển thị tag
                function createTagElement(tagText) {
                    const span = document.createElement('span');
                    span.className =
                        'bg-primary-100 text-primary-800 text-sm font-bold px-3 py-1 rounded-full flex items-center';
                    span.innerHTML = `
                    ${tagText}
                    <button class="ml-2 text-primary-600 hover:text-primary-800">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                    // Xử lý sự kiện xóa tag
                    span.querySelector('button').addEventListener('click', function() {
                        const currentTags = inputTags.value.split(',').filter(t => t.trim() !== tagText);
                        inputTags.value = currentTags.join(',');
                        span.remove();
                    });

                    tagContainer.appendChild(span);
                }

                // Xử lý thêm tag mới
                buttonAddTag.addEventListener('click', function() {
                    const newTag = inputAddTag.value.trim();
                    if (newTag) {
                        const currentTags = inputTags.value ? inputTags.value.split(',') : [];
                        if (!currentTags.includes(newTag)) {
                            currentTags.push(newTag);
                            inputTags.value = currentTags.join(',');
                            createTagElement(newTag);
                            inputAddTag.value = '';
                        }
                    }
                });

                // Xử lý thêm tag khi nhấn Enter
                inputAddTag.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        buttonAddTag.click();
                    }
                });

                // Khởi tạo tags ban đầu
                initializeTags();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const videoInput = document.getElementById('video-upload');
                const videoNameDisplay = document.querySelector('.drag-drop-zone h3');

                if (videoInput && videoNameDisplay) {
                    videoInput.addEventListener('change', function(e) {
                        if (e.target.files.length > 0) {
                            const file = e.target.files[0];
                            videoNameDisplay.textContent = file.name;
                        } else {
                            videoNameDisplay.textContent = 'Kéo và thả video vào đây';
                        }
                    });
                }
            });
        </script>
        <script>
            // Xử lý hiển thị tên file khi chọn file
            function updateFileHeading(inputElement) {
                const fileHeading = inputElement.closest('.drag-drop-zone').querySelector('.file-heading');
                const files = inputElement.files;

                if (files.length > 0) {
                    fileHeading.textContent = files[0].name;
                } else {
                    fileHeading.textContent = 'Kéo và thả tài liệu vào đây';
                }
            }

            // Thêm sự kiện onchange cho tất cả input file
            document.querySelectorAll('input[type="file"]').forEach(input => {
                input.addEventListener('change', function() {
                    updateFileHeading(this);
                });
            });
        </script>

        <script>
            const trueAnswerCheckBox = document.querySelectorAll('.true-answer');
            trueAnswerCheckBox.forEach(checkBox => {
                checkBox.addEventListener('change', function() {
                    if (this.checked) {
                        checkBox.closest('div').querySelector('label').classList.add('bg-green-600',
                            'text-white', 'px-4', 'rounded-full', 'transition-all');
                    } else {
                        checkBox.closest('div').querySelector('label').classList.remove('bg-green-600',
                            'text-white', 'px-4', 'rounded-full', 'transition-all');
                    }
                    refreshAnswers()
                });
            });

            refreshAnswers = () => {
                trueAnswerCheckBox.forEach(checkBox => {
                    if (checkBox.checked) {
                        checkBox.closest('div').querySelector('label').classList.add('bg-green-600', 'text-white',
                            'px-4', 'rounded-full', 'transition-all');
                    } else {
                        checkBox.closest('div').querySelector('label').classList.remove('bg-green-600',
                            'text-white', 'px-4', 'rounded-full', 'transition-all');
                    }
                });
            }
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const showHideBtns = document.querySelectorAll('.show-hide');
                showHideBtns.forEach(btn => {
                    btn.addEventListener('click', function() {

                        btn.closest('.question-container').querySelectorAll('.question-content')
                            .forEach(e => {
                                e.classList.toggle('hidden');
                                btn.querySelector('svg').classList.toggle('rotate-180');
                       
                            })
                    });
                });

            })
        </script>
        <script>
            const submit = document.querySelector('#push-lession');
            submit.addEventListener('click', function() {
                submit.closest('form').submit();
            })
        </script>
        <script>
            const videoType = document.querySelector('#video-type');
        </script>
        <script>
            const lessonType = document.getElementById('lesson_type_id');
            const classInput = document.querySelector('select[name="class_id"]');
            const subjectInput = document.querySelector('select[name="subject_id"]');
            //lesson_type.get_relationships
            lessonType.addEventListener('change', function() {
                fetch(`{{ route('lesson_type.get_relationships') }}?lesson_type_id=${lessonType.value}`)
                    .then(response => response.json())
                    .then(data => {
                        classInput.value = data.class_id;
                        subjectInput.value = data.subject_id;
                    });
            })
            lessonType.dispatchEvent(new Event('change'));
        </script>
        <script>
            const newDocumentElement = `
                <div class="border-2 border-gray-200 rounded-xl p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Tài liệu 2</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                <div>
                                    <label for="resource-title-2" class="block text-lg font-bold text-gray-700 mb-2">Tiêu đề
                                        tài liệu <span class="text-red-500">*</span></label>
                                    <input type="text" id="resource-title-2" name="resource_title[]"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                        placeholder="Nhập tiêu đề tài liệu" value="Bài tập thực hành: Phép cộng và trừ">
                                </div>

                                <div>
                                    <label for="resource-type-2" class="block text-lg font-bold text-gray-700 mb-2">Loại tài
                                        liệu <span class="text-red-500">*</span></label>
                                    <select id="resource-type-2" name="resource_type[]"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        <option value="pdf" selected>PDF</option>
                                        <option value="doc">Word Document</option>
                                        <option value="ppt">PowerPoint</option>
                                        <option value="bg">Bài giảng</option>

                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="resource-description-2" class="block text-lg font-bold text-gray-700 mb-2">Mô tả
                                    tài liệu</label>
                                <textarea id="resource-description-2" name="resource_description[]" rows="2"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Mô tả ngắn về tài liệu">Bài tập thực hành về phép cộng và trừ trong phạm vi 100 cho học sinh lớp 2.</textarea>
                            </div>

                            <div class="drag-drop-zone rounded-xl p-6 text-center cursor-pointer">
                                <div class="mb-3">
                                    <i class="fas fa-file text-4xl text-red-500"></i>
                                </div>
                                <h4 class="file-heading text-lg font-bold text-gray-700 mb-2">Kéo và thả tài liệu vào đây</h4>
                                <p class="text-gray-500 mb-3">hoặc</p>
                                <label
                                    class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                                    <i class="fas fa-upload mr-2"></i>
                                    Chọn tài liệu
                                    <input type="file" id="resource-file-2" name="resource_file[]" class="hidden">
                                </label>
                                <p class="text-sm text-gray-500 mt-3">Hỗ trợ: PDF, ZIP,  DOC, DOCX, PPT, PPTX, v.v.</p>
                            </div>
                        </div>
                `
            const addDocumentBtn = document.getElementById('add-a-document-btn');
            const documentContainer = document.getElementById('documents-container');
            addDocumentBtn.addEventListener('click', function() {
                documentContainer.insertAdjacentHTML('beforeend', newDocumentElement);
            })
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const typevideo = document.querySelectorAll('[name="video_type"]');
                const inputFileVideo = document.getElementById('video-upload');
                typevideo.forEach(type => {
                    type.addEventListener('change', function() {
                        if (this.value == 'zip') {
                            inputFileVideo.setAttribute('accept', '.zip, application/zip');
                        }
                        if (this.value == 'mp4') {
                            inputFileVideo.setAttribute('accept', '.mp4,video/mp4');
                        }
                    })
                    type.dispatchEvent(new Event('change'));
                })
            })
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const nextToExamBtn = document.querySelector('[data-next="quiz"]');

                // scroll to top when clicking next button
                nextToExamBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });

            })
        </script>
    @endpush
