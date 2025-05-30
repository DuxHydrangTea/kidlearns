@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between p-4 border-b">
        <h1 class="text-2xl font-semibold">Quản lý khóa học</h1>
        <a href="{{ route('admin.courses.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Thêm khóa học
        </a>
    </div>
    
    <div class="p-4">
        <div class="flex items-center space-x-4 mb-4">
            <div class="flex-1">
                <input type="text" placeholder="Tìm kiếm khóa học..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên khóa học</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mô tả</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($courses as $course)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">{{ $course->name }}</div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $course->description }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $course->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" class="inline">
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