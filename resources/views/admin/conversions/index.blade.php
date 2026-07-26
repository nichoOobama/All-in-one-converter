@extends('admin.layouts.admin')

@section('title', 'Conversions')

@section('content')
<h1 class="text-2xl font-bold mb-6">Conversions</h1>

<!-- Filters -->
<div class="bg-white rounded-lg shadow p-4 mb-4">
    <form action="{{ route('admin.conversions.index') }}" method="GET" class="flex gap-4 flex-wrap">
        <input type="text" name="search" placeholder="Search filename..." value="{{ request('search') }}" class="border rounded px-3 py-2 flex-1">
        <select name="status" class="border rounded px-3 py-2">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
            <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
        </select>
        <select name="category" class="border rounded px-3 py-2">
            <option value="">All Categories</option>
            <option value="image" {{ request('category') === 'image' ? 'selected' : '' }}>Image</option>
            <option value="video" {{ request('category') === 'video' ? 'selected' : '' }}>Video</option>
            <option value="audio" {{ request('category') === 'audio' ? 'selected' : '' }}>Audio</option>
            <option value="document" {{ request('category') === 'document' ? 'selected' : '' }}>Document</option>
            <option value="spreadsheet" {{ request('category') === 'spreadsheet' ? 'selected' : '' }}>Spreadsheet</option>
            <option value="presentation" {{ request('category') === 'presentation' ? 'selected' : '' }}>Presentation</option>
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="border rounded px-3 py-2">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="border rounded px-3 py-2">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
</div>

<!-- Conversions Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">UUID</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">File</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Source</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Target</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Category</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Date</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($conversions as $conversion)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-mono text-xs">{{ substr($conversion->uuid, 0, 8) }}...</td>
                    <td class="px-4 py-3">{{ $conversion->source_filename }}</td>
                    <td class="px-4 py-3 text-sm">{{ strtoupper($conversion->source_extension) }}</td>
                    <td class="px-4 py-3 text-sm">{{ strtoupper($conversion->target_extension) }}</td>
                    <td class="px-4 py-3 text-sm">{{ $conversion->category }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $conversion->status->value === 'completed' ? 'bg-green-100 text-green-800' : ($conversion->status->value === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $conversion->status->value }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $conversion->created_at->format('Y-m-d H:i') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.conversions.show', $conversion->id) }}" class="text-blue-500 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">No conversions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $conversions->links() }}
</div>
@endsection
