@extends('admin.layouts.admin')

@section('title', 'Edit Version')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Edit Version</h1>
    <a href="{{ route('admin.versions.index') }}" class="text-blue-500 hover:underline">Back to Versions</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.versions.update', $version->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Version Number</label>
                <input type="text" name="version_number" value="{{ old('version_number', $version->version_number) }}" class="border rounded w-full px-3 py-2" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Platform</label>
                <select name="platform" class="border rounded w-full px-3 py-2" required>
                    <option value="windows" {{ $version->platform === 'windows' ? 'selected' : '' }}>Windows</option>
                    <option value="android" {{ $version->platform === 'android' ? 'selected' : '' }}>Android</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Download URL</label>
            <input type="text" name="download_url" value="{{ old('download_url', $version->download_url) }}" class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">File Size (bytes)</label>
                <input type="number" name="file_size" value="{{ old('file_size', $version->file_size) }}" class="border rounded w-full px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Min Supported Version</label>
                <input type="text" name="min_supported_version" value="{{ old('min_supported_version', $version->min_supported_version) }}" class="border rounded w-full px-3 py-2">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Changelog (one per line)</label>
            <textarea name="changelog" class="border rounded w-full px-3 py-2" rows="4">{{ old('changelog', is_array($version->changelog) ? implode("\n", $version->changelog) : $version->changelog) }}</textarea>
        </div>

        <div class="flex gap-6 mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_critical" value="1" {{ old('is_critical', $version->is_critical) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Is Critical</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="force_update" value="1" {{ old('force_update', $version->force_update) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Force Update</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $version->is_active) ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Is Active</span>
            </label>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Version</button>
            <a href="{{ route('admin.versions.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
