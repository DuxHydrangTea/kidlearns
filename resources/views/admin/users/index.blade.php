@extends('admin.layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between p-4 border-b">
        <h1 class="text-2xl font-semibold">Quản lý người dùng</h1>
        
    </div>
    
    <div class="p-4">
        <div class="flex items-center space-x-4 mb-4">
            <div class="flex-1">
                <input type="text" placeholder="Tìm kiếm người dùng..." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Xác thực email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cập nhật</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vai trò</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->email_verified_at }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center">
                                <img src="{{ asset($user->avatar) }}" alt="" class="w-10 h-10 rounded-full object-cover">
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{-- {{ $user->role == 99 ? "Super Admin" : "Thành viên" }} --}}
                            <select name="role" data-user-id="{{$user->id}}"  class="border-2 border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="0">Người dùng</option>
                                <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Học sinh</option>
                                <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Giáo viên</option>
                                <option value="99" {{ $user->role == 99 ? 'selected' : '' }}>Quản trị viên</option>
                            </select>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex items-center space-x-2">
                              
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
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

<script>
    const roleSelects = document.querySelectorAll('select[name="role"]');
    
    roleSelects.forEach(select => {
         const userId = select.getAttribute('data-user-id');
        select.addEventListener('change', function() {
            const newRole = this.value;

            var url = '/admin/users/change-role?user_id=' + userId + '&role_id=' + newRole;
            fetch(url)
            .then(response => response.json())
            .then(data => {
               
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection
