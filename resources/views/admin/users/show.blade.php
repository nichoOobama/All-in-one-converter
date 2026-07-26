@extends('admin.layouts.admin')

@section('title', 'User Detail')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">User: {{ $user->name }}</h1>
    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:underline">Back to Users</a>
</div>

<!-- User Info -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="text-gray-500 text-sm">ID</label>
            <p class="font-semibold">{{ $user->id }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Name</label>
            <p class="font-semibold">{{ $user->name }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Email</label>
            <p class="font-semibold">{{ $user->email }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Role</label>
            <p>
                <span class="px-2 py-1 rounded text-xs {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ $user->role }}
                </span>
            </p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Joined</label>
            <p>{{ $user->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <div class="mt-4 flex gap-2">
        <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">
                Toggle Role ({{ $user->role === 'admin' ? 'Make User' : 'Make Admin' }})
            </button>
        </form>
        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user and all their data?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete User</button>
        </form>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Conversions</h3>
        <p class="text-2xl font-bold">{{ $stats['total_conversions'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Total Licenses</h3>
        <p class="text-2xl font-bold">{{ $stats['total_licenses'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Active Licenses</h3>
        <p class="text-2xl font-bold text-green-600">{{ $stats['active_licenses'] }}</p>
    </div>
</div>

<!-- Licenses -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <h2 class="text-lg font-bold mb-4">Licenses</h2>
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Key</th>
                <th class="text-left py-2">Type</th>
                <th class="text-left py-2">Status</th>
                <th class="text-left py-2">Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user->licenses as $license)
                <tr class="border-b">
                    <td class="py-2 font-mono text-sm">{{ $license->license_key }}</td>
                    <td class="py-2">{{ ucfirst($license->type) }}</td>
                    <td class="py-2">
                        <span class="px-2 py-1 rounded text-xs {{ $license->status === 'active' ? 'bg-green-100 text-green-800' : ($license->status === 'used' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                            {{ $license->status }}
                        </span>
                    </td>
                    <td class="py-2 text-sm text-gray-500">{{ $license->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">No licenses.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Recent Conversions -->
<div class="bg-white rounded-lg shadow p-4">
    <h2 class="text-lg font-bold mb-4">Recent Conversions</h2>
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">File</th>
                <th class="text-left py-2">Category</th>
                <th class="text-left py-2">Status</th>
                <th class="text-left py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user->conversions as $conversion)
                <tr class="border-b">
                    <td class="py-2">{{ $conversion->source_filename }}</td>
                    <td class="py-2">{{ $conversion->category }}</td>
                    <td class="py-2">
                        <span class="px-2 py-1 rounded text-xs {{ $conversion->status->value === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $conversion->status->value }}
                        </span>
                    </td>
                    <td class="py-2 text-sm text-gray-500">{{ $conversion->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">No conversions.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
