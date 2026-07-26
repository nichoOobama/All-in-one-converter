@extends('admin.layouts.admin')

@section('title', 'Versions')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Versions</h1>
    <a href="{{ route('admin.versions.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add Version</a>
</div>

<!-- Versions Table -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Version</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Platform</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Critical</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Force Update</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Active</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Created</th>
                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse ($versions as $version)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $version->id }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $version->version_number }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs {{ $version->platform === 'windows' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                            {{ ucfirst($version->platform) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if ($version->is_critical)
                            <span class="text-red-600 font-bold">Yes</span>
                        @else
                            <span class="text-gray-400">No</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if ($version->force_update)
                            <span class="text-red-600 font-bold">Yes</span>
                        @else
                            <span class="text-gray-400">No</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        @if ($version->is_active)
                            <span class="text-green-600">Active</span>
                        @else
                            <span class="text-red-600">Inactive</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-500">{{ $version->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.versions.edit', $version->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.versions.destroy', $version->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="px-4 py-8 text-center text-gray-500">No versions yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
