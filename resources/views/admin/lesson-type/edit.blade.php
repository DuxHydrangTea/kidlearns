@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between p-4 border-b">
        <h1 class="text-2xl font-semibold">Thêm loại bài học mới</h1>
    </div>
    
    <div class="p-4">
        <form action="{{ route('admin.lesson-type.update', $lessonType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tên loại bài học</label>
                <input type="file" 
                       name="thumbnail" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                       value="{{ old('name') }}" 
                       accept="image/*"
                       >
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Tên loại bài học</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                       value="{{$lessonType->name}}" 
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="class_id" class="block text-sm font-medium text-gray-700 mb-2">Lớp học</label>
                <select name="class_id" id="class_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('class_id') border-red-500 @enderror">
                    <option value="">Chọn lớp học</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ $lessonType->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-2">Môn học</label>
                <select name="subject_id" id="subject_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subject_id') border-red-500 @enderror">
                    <option value="">Chọn môn học</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ $lessonType->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Khóa học</label>
                <select name="course_id" id="course_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('course_id') border-red-500 @enderror">
                    <option value="">Chọn khóa học</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $lessonType->course_id == $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                    @endforeach
                </select>
                @error('course_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Mô tả</label>
                <textarea name="description" 
                          id="description" 
                          rows="4" 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ $lessonType->description }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.lesson-type.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">
                    Hủy
                </a>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Xác nhận
                </button>
            </div>
        </form>
    </div>
</div>
@endsection