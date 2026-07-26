@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard</h1>

<!-- Stats Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Total Users</h3>
        <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Total Conversions</h3>
        <p class="text-3xl font-bold">{{ $stats['total_conversions'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Total Licenses</h3>
        <p class="text-3xl font-bold">{{ $stats['total_licenses'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Total Versions</h3>
        <p class="text-3xl font-bold">{{ $stats['total_versions'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Today's Conversions</h3>
        <p class="text-3xl font-bold text-blue-600">{{ $stats['conversions_today'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="text-gray-500 text-sm">Revenue (Licenses)</h3>
        <p class="text-3xl font-bold text-green-600">${{ number_format($stats['revenue'], 2) }}</p>
    </div>
</div>

<!-- Recent Conversions -->
<div class="bg-white rounded-lg shadow p-4 mb-8">
    <h2 class="text-lg font-bold mb-4">Recent Conversions</h2>
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">UUID</th>
                <th class="text-left py-2">File</th>
                <th class="text-left py-2">Category</th>
                <th class="text-left py-2">Status</th>
                <th class="text-left py-2">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentConversions as $conversion)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 text-sm">{{ substr($conversion['uuid'], 0, 8) }}...</td>
                    <td class="py-2">{{ $conversion['filename'] }}</td>
                    <td class="py-2">{{ $conversion['category'] }}</td>
                    <td class="py-2">
                        <span class="px-2 py-1 rounded text-xs {{ $conversion['status'] === 'completed' ? 'bg-green-100 text-green-800' : ($conversion['status'] === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $conversion['status'] }}
                        </span>
                    </td>
                    <td class="py-2 text-sm text-gray-500">{{ $conversion['created_at'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-4 text-center text-gray-500">No conversions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Recent Users -->
<div class="bg-white rounded-lg shadow p-4">
    <h2 class="text-lg font-bold mb-4">Recent Users</h2>
    <table class="w-full">
        <thead>
            <tr class="border-b">
                <th class="text-left py-2">Name</th>
                <th class="text-left py-2">Email</th>
                <th class="text-left py-2">Role</th>
                <th class="text-left py-2">Joined</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentUsers as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">{{ $user->name }}</td>
                    <td class="py-2">{{ $user->email }}</td>
                    <td class="py-2">
                        <span class="px-2 py-1 rounded text-xs {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="py-2 text-sm text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-center text-gray-500">No users yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
