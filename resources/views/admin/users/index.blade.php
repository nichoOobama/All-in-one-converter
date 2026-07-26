@extends('admin.layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Users</h1>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-4">
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" placeholder="Search name or email..." value="{{ request('search') }}" class="border rounded px-3 py-2 flex-1">
        <select name="role" class="border rounded px-3 py-2">
            <option value="">All Roles</option>
            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Role</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Joined</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $user->id }}</td>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
