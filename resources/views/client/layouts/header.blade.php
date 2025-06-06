@php
  $indexMenu = isset($indexMenu) ? $indexMenu : 1;
@endphp
<header class="bg-white shadow-md sticky top-0 z-50" x-data="{dialog: false}">
    <div class="absolute p-3 w-[900px] shadow-2xl left-1/2 translate-x-[-50%] top-full bg-white border-2 border-gray-200 rounded-2xl"  x-show="dialog"
    @click.away="dialog = false"
    >
        <button class=" w-[50px] h-[50px] absolute right-[1rem] top-[1rem] outline-none hover:text-primary-600" @click="dialog = !dialog" >
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M8.47 8.47a.75.75 0 0 1 1.06 0L12 10.94l2.47-2.47a.75.75 0 1 1 1.06 1.06L13.06 12l2.47 2.47a.75.75 0 0 1-1.06 1.06L12 13.06l-2.47 2.47a.75.75 0 1 1-1.06-1.06L10.94 12L8.47 9.53a.75.75 0 0 1 0-1.06"/><path fill="currentColor" fill-rule="evenodd" d="M7.317 3.769a42.5 42.5 0 0 1 9.366 0c1.827.204 3.302 1.643 3.516 3.48c.37 3.157.37 6.346 0 9.503c-.215 1.837-1.69 3.275-3.516 3.48a42.5 42.5 0 0 1-9.366 0c-1.827-.205-3.302-1.643-3.516-3.48a41 41 0 0 1 0-9.503c.214-1.837 1.69-3.276 3.516-3.48m9.2 1.49a41 41 0 0 0-9.034 0A2.486 2.486 0 0 0 5.29 7.424a39.4 39.4 0 0 0 0 9.154a2.486 2.486 0 0 0 2.193 2.164c2.977.332 6.057.332 9.034 0a2.486 2.486 0 0 0 2.192-2.164a39.4 39.4 0 0 0 0-9.154a2.486 2.486 0 0 0-2.192-2.163" clip-rule="evenodd"/></svg>
        </button>
        <h1 class="text-2xl text-primary-500 font-bold mb-5 text-center">Thông tin cá nhân</h1>
        <form action="{{route('home.update_profile')}}" method="POST" enctype="multipart/form-data" class="flex gap-5">
            @csrf
            <div class="max-w-[300px]">
                <img src="{{asset(auth()->user()->avatar)}}" class="w-full h-full aspect-square object-cover rounded-xl border-2 border-gray-200" alt="" id="avatar-img">
            </div>
            <div class="flex-1 flex flex-col gap-5">
                <div class="w-full">
                    <p class="mb-2 font-bold">Họ tên</p>
                    <input type="text" name="name" class="border-2 border-gray-200 w-full outline-none p-2 rounded" value="{{auth()->user()->name}}">
                </div>
                <div class="w-full">
                    <p class="mb-2 font-bold">Email</p>
                    <input type="email" class="border-2 border-gray-200 w-full outline-none p-2 rounded" value="{{auth()->user()->email}}" disabled>
                </div>
                <label class="w-full">
                    <p class="mb-2 font-bold">Ảnh đại diện</p>
                    <input type="file" name="avatar" class="border-2 border-gray-200 w-full outline-none p-2 rounded hidden" accept="image/*"
                    onchange="document.getElementById('avatar-img').src = window.URL.createObjectURL(this.files[0])"
                    >
                    <div class="border-2 border-primary-200 rounded-xl cursor-pointer hover:text-primary-500 hover:bg-primary-100 w-full outline-none p-2"> Tải ảnh lên </div>
                </label>

                <div class="">
                    <button type="submit" class="border-2 border-gray-200 outline-none p-2 w-fit block bg-purple-700 text-white px-5 rounded ml-auto">Xác nhận</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <a href="/" class="flex-shrink-0 flex items-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/2436/2436636.png" alt="Logo"
                        class="w-12 h-12 mr-2" />
                    <span class="text-primary-600 text-3xl font-bold">Tài Liệu<span
                            class="text-secondary-500">Tiểu Học</span></span>
                </a>
                <nav class="hidden md:ml-8 md:flex md:space-x-8">
                    <a href="{{ route('home.index') }}"
                        class=" {{$indexMenu == 1 ? ' text-primary-600 border-primary-500 border-b-2 ' : ' text-gray-500 '}}  px-1 pt-1 font-bold text-lg">Trang chủ</a>
                    <div href="{{ route('lesson_type.index') }}"
                        class="relative group flex justify-between items-center hover:text-gray-700 {{$indexMenu == 2 ? ' text-primary-600 border-primary-500 border-b-2 ' : ' text-gray-500 '}} hover:border-gray-300 px-1 pt-1 font-bold text-lg">
                        
                      <span>Bài học</span>  

                      <svg class="rotate-90" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8 5v2h2V5zm4 4V7h-2v2zm2 2V9h-2v2zm0 2h2v-2h-2zm-2 2v-2h2v2zm0 0h-2v2h2zm-4 4v-2h2v2z"/></svg>

                      @php
                        use App\Models\ClassModel;
                        use App\Models\Subject;
                        $subjects = Subject::all();
                        $classes = ClassModel::all();
                        @endphp
                        <div class="absolute hidden group-hover:flex flex-col top-full p-3 text-sm right-1/2 translate-x-[50%] w-[200px] bg-white border-2 border-gray-400 rounded">
                            @foreach ($subjects as  $subject)
                                <div href="{{route('class.index', $subject->id )}}" class="py-3 group/l1 flex justify-between items-center relative hover:bg-gray-100 px-2 hover:text-[#e4588a]">
                                    <span>{{$subject->name}}</span>

                                    <svg class="group-hover/l1:translate-x-[10px] transition-all" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8 5v2h2V5zm4 4V7h-2v2zm2 2V9h-2v2zm0 2h2v-2h-2zm-2 2v-2h2v2zm0 0h-2v2h2zm-4 4v-2h2v2z"/></svg>


                                    <div class="absolute group-hover/l1:flex  hidden flex-col top-0 p-3 text-sm  left-full w-[200px] bg-white border-2 border-gray-400 rounded ">
                                        @foreach ($classes as  $class)
                                            <a href="{{route('lesson_type.index', [
                                            'class_id' => $class->id,
                                            'subject_id' => $subject->id,
                                            ])}}" class="py-3 hover:bg-gray-100 px-2 hover:text-[#e4588a]">{{$class->name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{route('quiz.index')}}"
                        class=" hover:text-gray-700 {{$indexMenu == 3 ? ' text-primary-600 border-primary-500 border-b-2 ' : ' text-gray-500 '}} hover:border-gray-300 px-1 pt-1 font-bold text-lg">
                        Quiz
                    </a>
                    <a href="{{route('document.index')}}"
                        class=" hover:text-gray-700 {{$indexMenu == 4 ? ' text-primary-600 border-primary-500 border-b-2 ' : ' text-gray-500 '}} hover:border-gray-300 px-1 pt-1 font-bold text-lg">
                        Tài liệu
                    </a>
                    <div href="#"
                        class=" group cursor-pointer flex justify-between items-center hover:text-gray-700 relative {{$indexMenu == 5 ? ' text-primary-600 border-primary-500 border-b-2 ' : ' text-gray-500 '}} hover:border-gray-300 px-1 pt-1 font-bold text-lg">
                        <span> Lớp</span>
                        <svg class="rotate-90" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M8 5v2h2V5zm4 4V7h-2v2zm2 2V9h-2v2zm0 2h2v-2h-2zm-2 2v-2h2v2zm0 0h-2v2h2zm-4 4v-2h2v2z"/></svg>
                        @php
                        @endphp
                        <div class="absolute hidden group-hover:flex flex-col top-full p-3 text-sm right-1/2 translate-x-[50%] w-[200px] bg-white border-2 border-gray-400 rounded">
                            @foreach ($classes as  $class)
                                <a href="{{route('class.index', $class->id )}}" class="py-3 hover:bg-gray-100 px-2 hover:text-[#e4588a]">{{$class->name}}</a>
                            @endforeach
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div class="flex items-center">
                <div class="hidden md:flex items-center space-x-4">
                    <div class="relative" x-data="{ open: false }">
                        <button type="button" class="flex items-center text-gray-700 hover:text-primary-600 font-bold"
                            id="user-menu-button" @click="open = !open" aria-expanded="false" aria-haspopup="true">
                            <img class="h-10 w-10 rounded-full object-cover border-2 border-primary-300"
                                src="{{ asset(auth()->user()->avatar ?? 'storage/uploads/logo.png') }}"
                                alt="User" />
                            <span class="ml-2 text-lg">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show.transition="open" @click.away="open = false" 
                            class="absolute right-0 z-10 mt-2 w-80 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                            <button @click="dialog = !dialog, open = !open" class=" w-full flex items-center gap-2 justify-start px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem">
                                <i class="fas fa-user"></i>
                                <span>Chỉnh sửa thông tin tài khoản</span>
                            </button>

                            <a href="{{route('history.my_history')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                <i class="fas fa-chart-line"></i>
                               Việc học của tôi
                            </a>

                            
                            @role(99)
                            <a href="{{route('history.other_history')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full">
                                <i class="fas fa-chart-line"></i>
                               Tiến trình học sinh
                            </a>
                            
                            <a href="{{route('admin.classes.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                role="menuitem">
                                <i class="fas fa-user"></i>
                                <span>Trang quản trị</span>
                            </a>
                           
                            <div href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 relative group"
                                role="menuitem">
                                <i class="fas fa-book"></i>
                                <span>Quản lý tài liệu</span>

                                <div class="hidden 
                                group-hover:flex
                                transition-all
                                overflow-hidden
                                border-2 border-gray-200
                                 flex-col gap-1 absolute top-0 right-full bg-white w-full rounded">
                                    <a href="{{route('document.create')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">

                                        <i class="fas fa-upload"></i>
                                        <span>Upload tài liệu</span>
                                    </a>
                                    <a href="{{route('document.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem">

                                        <i class="fas fa-upload"></i>
                                        <span>Quản lý tài liệu</span>
                                    </a>
                                </div>
                            </div>
                            @endrole
                        </div>
                    </div>
                    <a href="{{ route('auth.logout') }}"
                        class="inline-flex gap-2 items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                        {{-- <i class="  "></i> --}}
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Đăng xuất</span>
                    </a>
                </div>
                <div class="flex md:hidden">
                    <button type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
