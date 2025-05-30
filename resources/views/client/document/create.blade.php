@extends('client.layouts.layout')
@push('styles')
@endpush
@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-primary-600 to-secondary-500 py-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-600/80 to-secondary-500/80"></div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-2/3 text-center md:text-left mb-6 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Tạo Tài Liệu Học Tập</h1>
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

    <!-- Main Content -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row">
                <!-- Left Column - Document Form -->
                <form action="{{route('document.store')}}" enctype="multipart/form-data" method="POST" class="lg:w-2/3 lg:pr-8 mb-8 lg:mb-0">
                    <!-- Document Info Form -->
                    @csrf
                    <div class="bg-blue-50 rounded-2xl p-6 border-2 border-blue-100 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Thông tin Tài liệu</h2>

                        <div class="space-y-6">
                            <div>
                                <label for="document-title" class="block text-lg font-bold text-gray-700 mb-2">Tiêu
                                    đề</label>
                                <input type="text" id="document-title" name="title"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Nhập tiêu đề tài liệu"
                                    value="Bài giảng Toán lớp 2: Phép cộng và trừ trong phạm vi 100">
                            </div>

                            <div>
                                <label for="document-description" class="block text-lg font-bold text-gray-700 mb-2">Mô
                                    tả</label>
                                <textarea id="document-description" name="description" rows="3"
                                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg"
                                    placeholder="Mô tả ngắn về tài liệu">Tài liệu hướng dẫn học sinh lớp 2 thực hiện các phép tính cộng và trừ trong phạm vi 100. Bao gồm lý thuyết, ví dụ minh họa và bài tập thực hành.</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="document-subject" class="block text-lg font-bold text-gray-700 mb-2">Môn
                                        học</label>
                                    <select id="document-subject" name="subject_id"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        @foreach ($subjects as $subject )
                                            <option value="{{$subject->id}}" >{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="document-grade"
                                        class="block text-lg font-bold text-gray-700 mb-2">Lớp</label>
                                    <select id="document-grade" name="class_id"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        @foreach ($classes as $class )
                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="document-type" class="block text-lg font-bold text-gray-700 mb-2">Loại tài
                                        liệu</label>
                                    <select id="document-type" name="type"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        <option value="lesson" selected>Bài giảng</option>
                                        <option value="worksheet">Bài tập</option>
                                        <option value="exam">Đề kiểm tra</option>
                                        <option value="reference">Tài liệu tham khảo</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="document-access" class="block text-lg font-bold text-gray-700 mb-2">Quyền
                                        truy cập</label>
                                    <select id="document-access" name="access"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                        <option value="public" selected>Công khai</option>
                                        <option value="private">Riêng tư</option>
                                        <option value="restricted">Giới hạn (chỉ học sinh của tôi)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="document-cover" class="block text-lg font-bold text-gray-700 mb-2">Ảnh
                                    bìa</label>
                                <div class="flex items-center">
                                    <div
                                        class="w-24 h-24 bg-gray-100 rounded-xl flex items-center justify-center mr-4 overflow-hidden">
                                        <img id="document-cover-preview"
                                            src="https://img.freepik.com/free-vector/hand-drawn-colorful-math-background_23-2148157266.jpg"
                                            alt="Document Cover" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <label
                                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl cursor-pointer hover:bg-primary-700">
                                            <i class="fas fa-upload mr-2"></i>
                                            Tải lên ảnh bìa
                                            <input type="file" id="document-cover" name="thumbnail" class="hidden"
                                                accept="image/*"
                                                onchange="document.getElementById('document-cover-preview').src = window.URL.createObjectURL(this.files[0])">
                                        </label>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG hoặc GIF (tối đa 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-700 mb-2">Thẻ (Tags)</label>
                                <div class="flex flex-wrap gap-2 mb-2"></div>
                                <input type="text" name="tags" hidden="">
                                <div class="flex gap-2 items-center">
                                    <input id="input-add-tag" type="text" placeholder="Thêm thẻ mới"
                                        class="px-4 py-2 rounded-xl border-2 border-gray-200 focus:border-primary-500 focus:outline-none text-lg">
                                    <button id="button-add-tag" type="button"
                                        class=" text-primary-600 hover:text-primary-800 px-4 h-full">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Content Section -->
                    <div class="mb-8" id="document-file-container">
                        <div class="flex justify-between items-center mb-6 document-upload gap-5">
                            <h2 class="text-2xl font-bold text-gray-900 flex-1">
                                <div class="flex items-center gap-2">
                                   <span>Tên tài liệu</span> <input type="text" class="font-normal text-xl p-2 border-2 border-gray-200 flex-1 "
                                   name="document_name[]"
                                   placeholder="Tài liệu tập boxing cho trẻ..."
                                   >     
                                </div>  
                                <p class="font-normal text-sm ml-4 file-name">File name</p>
                            </h2>
                            <div class="flex space-x-2">
                                <label
                                    class="inline-flex cursor-pointer items-center px-4 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700">
                                    <i class="fas fa-upload mr-2"></i>
                                    <input type="file" name="document_file[]" hidden id=""
                                        onchange="this.closest('.document-upload').querySelector('.file-name').textContent = this.files[0].name">
                                    Tải lên File
                                </label>
                                <button type="button" class="delete-document-element text-red-600 hover:scale-[1.5] transition-all"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7.378 5.531a2.75 2.75 0 0 1 1.92-.781h10.297c.598 0 1.294.166 1.863.519c.579.358 1.11.974 1.11 1.856v9.75c0 .882-.531 1.497-1.11 1.856a3.65 3.65 0 0 1-1.863.519H9.298a2.75 2.75 0 0 1-1.92-.781l-5.35-5.216a1.75 1.75 0 0 1 0-2.506zM14.03 9.47a.75.75 0 1 0-1.06 1.06L14.44 12l-1.47 1.47a.75.75 0 1 0 1.06 1.06l1.47-1.47l1.47 1.47a.75.75 0 1 0 1.06-1.06L16.56 12l1.47-1.47a.75.75 0 1 0-1.06-1.06l-1.47 1.47z" />
                                    </svg></button>
                            </div>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <button id="add-document-btn" type="button"
                            class="inline-flex ml-auto items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700">
                            <i class="fas fa-plus mr-2"></i>
                            Thêm tài liệu mới
                        </button>
                    </div>
                    <!-- Save Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-4">
                        <button type="button" class="px-6 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300">
                            Lưu nháp
                        </button>
                        <button type="button" class="px-6 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700">
                            Xem trước
                        </button>
                        <button class="px-6 py-3 bg-secondary-500 text-white font-bold rounded-xl hover:bg-secondary-600" type="submit">
                            Xuất bản
                        </button>
                    </div>
                </form>

                <!-- Right Column - Preview and Settings -->
                <div class="lg:w-1/3">
                    <div class="sticky top-24 space-y-6">
                        <!-- Document Preview -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden hidden">
                            <div class="bg-primary-50 p-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Xem trước</h3>
                            </div>
                            <div class="p-4">
                                <div class="bg-blue-50 rounded-xl p-4 border-2 border-blue-100 mb-4">
                                    <div class="flex items-center mb-2">
                                        <img src="https://img.freepik.com/free-vector/hand-drawn-colorful-math-background_23-2148157266.jpg"
                                            alt="Document" class="w-10 h-10 rounded-md object-cover mr-3">
                                        <div>
                                            <h4 class="text-lg font-bold text-gray-900">Bài giảng Toán lớp 2: Phép cộng và
                                                trừ...</h4>
                                            <div class="text-sm text-gray-500">Toán học • Lớp 2</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                                        <div>
                                            <i class="fas fa-file-pdf mr-1"></i>
                                            <span>5 trang</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            <span>21/05/2025</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-xl border-2 border-gray-200 p-4 mb-4 flex justify-center">
                                    <img src="https://img.freepik.com/free-vector/hand-drawn-colorful-math-background_23-2148157266.jpg"
                                        alt="PDF Preview" class="w-full h-48 object-cover rounded-lg">
                                </div>

                                <div class="text-center">
                                    <button
                                        class="px-4 py-2 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 text-sm">
                                        Xem trước đầy đủ
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Document Settings -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden not-dev">
                            <div class="bg-primary-50 p-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Cài đặt Tài liệu <span class="text-red-500">( Chưa phát triển )</span> </h3>
                            </div>
                            <div class="p-4">
                                <div class="space-y-4">
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked>
                                            <span class="ml-2 text-gray-700">Cho phép tải xuống</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked>
                                            <span class="ml-2 text-gray-700">Cho phép in</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                                checked>
                                            <span class="ml-2 text-gray-700">Cho phép chia sẻ</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox"
                                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                            <span class="ml-2 text-gray-700">Yêu cầu đăng nhập để xem</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 mb-2">Định dạng xuất</label>
                                        <select
                                            class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none">
                                            <option value="pdf" selected>PDF</option>
                                            <option value="docx">Word (DOCX)</option>
                                            <option value="pptx">PowerPoint (PPTX)</option>
                                            <option value="html">HTML</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 mb-2">Kích thước trang </label>
                                        <select
                                            class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:border-primary-500 focus:outline-none">
                                            <option value="a4" selected>A4</option>
                                            <option value="letter">Letter</option>
                                            <option value="legal">Legal</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Document Templates -->
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden ">
                            <div class="bg-primary-50 p-4 border-b border-gray-200">
                                <h3 class="text-xl font-bold text-gray-900">Mẫu tài liệu <span class="text-red-500">( Chưa phát triển )</span></h3>
                            </div>
                            <div class="p-4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div
                                        class="border-2 border-gray-200 hover:border-primary-300 rounded-lg p-2 cursor-pointer">
                                        <img src="https://img.freepik.com/free-vector/hand-drawn-colorful-math-background_23-2148157266.jpg"
                                            alt="Template" class="w-full h-20 object-cover rounded mb-2">
                                        <p class="text-xs text-center font-bold">Bài giảng</p>
                                    </div>
                                    <div
                                        class="border-2 border-gray-200 hover:border-primary-300 rounded-lg p-2 cursor-pointer">
                                        <img src="https://img.freepik.com/free-vector/hand-drawn-science-education-background_23-2148499325.jpg"
                                            alt="Template" class="w-full h-20 object-cover rounded mb-2">
                                        <p class="text-xs text-center font-bold">Bài tập</p>
                                    </div>
                                    <div
                                        class="border-2 border-gray-200 hover:border-primary-300 rounded-lg p-2 cursor-pointer">
                                        <img src="https://img.freepik.com/free-vector/hand-drawn-vietnamese-language-background_23-2149483215.jpg"
                                            alt="Template" class="w-full h-20 object-cover rounded mb-2">
                                        <p class="text-xs text-center font-bold">Đề kiểm tra</p>
                                    </div>
                                    <div
                                        class="border-2 border-gray-200 hover:border-primary-300 rounded-lg p-2 cursor-pointer">
                                        <img src="https://img.freepik.com/free-vector/hand-drawn-back-school-background_23-2149464866.jpg"
                                            alt="Template" class="w-full h-20 object-cover rounded mb-2">
                                        <p class="text-xs text-center font-bold">Trống</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
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

            const newDocumentElement = `
        <div class="flex justify-between items-center mb-6 document-upload gap-5">
                            <h2 class="text-2xl font-bold text-gray-900 flex-1">
                                <div class="flex items-center gap-2">
                                   <span>Tên tài liệu</span> <input type="text" class="font-normal text-xl p-2 border-2 border-gray-200 flex-1 "
                                   placeholder="Tài liệu tập boxing cho trẻ..."
                                   name="document_name[]"
                                   >     
                                </div>  
                                <p class="font-normal text-sm ml-4 file-name">File name</p>
                            </h2>
                            <div class="flex space-x-2">
                                <label
                                    class="inline-flex cursor-pointer items-center px-4 py-2 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700">
                                    <i class="fas fa-upload mr-2"></i>
                                    <input type="file" name="document_file[]" hidden id=""
                                        onchange="this.closest('.document-upload').querySelector('.file-name').textContent = this.files[0].name">
                                    Tải lên File
                                </label>
                                <button type="button" class="delete-document-element text-red-600 hover:scale-[1.5] transition-all"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M7.378 5.531a2.75 2.75 0 0 1 1.92-.781h10.297c.598 0 1.294.166 1.863.519c.579.358 1.11.974 1.11 1.856v9.75c0 .882-.531 1.497-1.11 1.856a3.65 3.65 0 0 1-1.863.519H9.298a2.75 2.75 0 0 1-1.92-.781l-5.35-5.216a1.75 1.75 0 0 1 0-2.506zM14.03 9.47a.75.75 0 1 0-1.06 1.06L14.44 12l-1.47 1.47a.75.75 0 1 0 1.06 1.06l1.47-1.47l1.47 1.47a.75.75 0 1 0 1.06-1.06L16.56 12l1.47-1.47a.75.75 0 1 0-1.06-1.06l-1.47 1.47z" />
                                    </svg></button>
                            </div>
                        </div>
        `;

            const addDocumentBtn = document.getElementById('add-document-btn')
            const deleteDocumentBtn = document.querySelectorAll('.delete-document-element');
            const documentFileContainer = document.getElementById('document-file-container');

            addDocumentBtn.addEventListener('click', function() {
                documentFileContainer.insertAdjacentHTML('beforeend', newDocumentElement);
                registerDeleteEvents();
            });

            function registerDeleteEvents() {
                const deleteDocumentBtn = document.querySelectorAll('.delete-document-element');
                deleteDocumentBtn.forEach(btn => {
                    btn.addEventListener('click', function() {
                        btn.closest('.document-upload').remove();
                    })
                })
            }

            // Gọi hàm này sau khi thêm element mới
            registerDeleteEvents();
        })
    </script>
@endpush
