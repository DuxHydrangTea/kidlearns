@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between p-4 border-b">
        <h1 class="text-2xl font-semibold">Quản lý chương học</h1>
        <a href="{{ route('admin.lesson-type.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Thêm chương học
        </a>
    </div>
    
    <div class="p-4">
        <div class="flex items-center space-x-4 mb-4">
            <div class="flex-1">
                <input type="text" placeholder="Tìm kiếm lớp học..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên lớp</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mô tả</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người tạo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Môn</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lớp</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khoá</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thời gian tạo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($lessonTypes as $lessonType)
                    <tr>
                        <td class="px-4 py-3">
                            <img src="{{asset($lessonType->thumbnail)}}" height="50px" width="50px" alt="">
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">{{ $lessonType->name }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $lessonType->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $lessonType->user?->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $lessonType->subject?->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $lessonType->class?->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $lessonType->course?->name }}</td>

                        <td class="px-4 py-3 text-sm text-gray-500">{{ $lessonType->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.lesson-type.edit', $lessonType->id) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.lesson-type.destroy', $lessonType->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection