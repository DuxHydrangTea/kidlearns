<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="{{ asset('assets/js/tw_config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link href="{{ asset('logo.png') }}" rel="icon" />
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Playwrite+US+Modern:wght@100..400&display=swap");

        body {
            font-family: "Playwrite US Modern", cursive;
        }
    </style>
    @stack('styles')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 bg-white shadow-lg w-64 transform transition-transform duration-200 ease-in-out translate-x-0" >
            <div class="flex items-center justify-center h-16 border-b">
                <img src="/logo.png" alt="Logo" class="h-8">
            </div>
            <nav class="mt-4 flex flex-col">
                <div class="flex-1">
                    <a href="" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-home mr-3"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{route('admin.users.index')}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-users mr-3"></i>
                        <span>Quản lý người dùng</span>
                    </a>
                    {{-- <a href="{{route('admin.courses.index')}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-book mr-3"></i>
                        <span>Quản lý khóa học</span>
                    </a> --}}
    
                    <a href="{{route('admin.classes.index')}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-book mr-3"></i>
                        <span>Quản lý lớp</span>
                    </a>
    
                    <a href="{{route('admin.subjects.index')}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-book mr-3"></i>
                        <span>Quản lý môn</span>
                    </a>
    
                    <a href="{{route('admin.lesson-type.index')}}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-book mr-3"></i>
                        <span>Quản lý chương học</span>
                    </a>
                </div>
                <div class="mt-5 ">
                    <a href="{{route('home.index')}}" class="flex text-center justify-center items-center px-6 py-3 bg-primary-100 text-primary-700 hover:bg-primary-200">Về trang khách</a>
                </div>
                

                {{-- <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-file-alt mr-3"></i>
                    <span>Quản lý tài liệu</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-question-circle mr-3"></i>
                    <span>Quản lý bài kiểm tra</span>
                </a> --}}
            </nav>
        </aside>

        <!-- Main content -->
        <div class="ml-0 lg:ml-64 transition-margin duration-200 ease-in-out">
            <!-- Top navbar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between h-16 px-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600 lg:hidden">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center">
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-gray-700 hover:text-gray-900">
                                <img src="https://ui-avatars.com/api/?name=Admin" alt="Admin" class="h-8 w-8 rounded-full">
                                <span class="ml-2">{{auth()->user()->email}}</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Thông tin tài khoản</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
</body>
</html>