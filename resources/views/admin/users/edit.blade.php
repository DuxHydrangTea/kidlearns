@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between p-4 border-b">
        <h1 class="text-2xl font-semibold">Chỉnh sửa người dùng</h1>
    </div>
    
    <div class="p-4">
        <form action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tên người dùng</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ $user->name }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ $user->email }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                <input type="file" 
                       name="avatar" 
                       id="avatar" 
                       accept="image/*"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('avatar') border-red-500 @enderror">
                @error('avatar')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Vai trò</label>
                <select name="role" 
                        id="role" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                        required>
                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Học sinh</option>
                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Giáo viên</option>
                    <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ $user->role == 99 ? 'selected' : '' }}>Super Admin</option>

                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Hủy
                </a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
@endsection