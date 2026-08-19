@extends('admin.layouts.admin')

@section('title', 'Users')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Users</h1>
</div>

<!-- Filters -->
<div class="bg-white rounded-xl shadow-sm border border-slate-100 p-4 mb-4">
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-3">
        <div class="relative flex-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" placeholder="Search name or email..." value="{{ request('search') }}" class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        </div>
        <select name="role" class="border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="">All Roles</option>
            <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
            Filter
        </button>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                    <th class="text-left px-5 py-3 font-medium">ID</th>
                    <th class="text-left px-5 py-3 font-medium">Name</th>
                    <th class="text-left px-5 py-3 font-medium">Email</th>
                    <th class="text-left px-5 py-3 font-medium">Role</th>
                    <th class="text-left px-5 py-3 font-medium">Joined</th>
                    <th class="text-left px-5 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-slate-500">{{ $user->id }}</td>
                        <td class="px-5 py-3 text-slate-800 font-medium">{{ $user->name }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $user->email }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-slate-500">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-5 py-3">
                            <a href="{{ route('admin.users.show', $user->id) }}" class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700 font-medium">
                                View
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-slate-400">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection