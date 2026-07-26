@extends('admin.layouts.admin')

@section('title', 'Licenses')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Licenses</h1>
    <a href="{{ route('admin.licenses.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Create License</a>
</div>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-4">
    <form action="{{ route('admin.licenses.index') }}" method="GET" class="flex gap-4">
        <input type="text" name="search" placeholder="Search license key..." value="{{ request('search') }}" class="border rounded px-3 py-2 flex-1">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="used" {{ request('status') === 'used' ? 'selected' : '' }}>Used</option>
            <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
        </select>
        <select name="type" class="border rounded px-3 py-2">
            <option value="">All Types</option>
            <option value="single" {{ request('type') === 'single' ? 'selected' : '' }}>Single</option>
            <option value="subscription" {{ request('type') === 'subscription' ? 'selected' : '' }}>Subscription</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
</div>

<!-- Licenses Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">License Key</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">User</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Type</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Used At</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($licenses as $license)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $license->id }}</td>
                    <td class="px-4 py-3 font-mono text-sm">{{ $license->license_key }}</td>
                    <td class="px-4 py-3">{{ $license->user->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ ucfirst($license->type) }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $license->status === 'active' ? 'bg-green-100 text-green-800' : ($license->status === 'used' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                            {{ $license->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $license->used_at ? $license->used_at->format('Y-m-d H:i') : '-' }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.licenses.show', $license->id) }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">No licenses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $licenses->links() }}
</div>
@endsection
