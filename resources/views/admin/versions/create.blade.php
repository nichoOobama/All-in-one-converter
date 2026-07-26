@extends('admin.layouts.admin')

@section('title', 'Add Version')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Add Version</h1>
    <a href="{{ route('admin.versions.index') }}" class="text-blue-500 hover:underline">Back to Versions</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.versions.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Version Number</label>
                <input type="text" name="version_number" value="{{ old('version_number') }}" class="border rounded w-full px-3 py-2" placeholder="1.2.0" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Platform</label>
                <select name="platform" class="border rounded w-full px-3 py-2" required>
                    <option value="windows">Windows</option>
                    <option value="android">Android</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Download URL</label>
            <input type="text" name="download_url" value="{{ old('download_url') }}" class="border rounded w-full px-3 py-2" placeholder="/downloads/windows/v1.2.0/setup.exe" required>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">File Size (bytes)</label>
                <input type="number" name="file_size" value="{{ old('file_size') }}" class="border rounded w-full px-3 py-2" placeholder="45000000">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Min Supported Version</label>
                <input type="text" name="min_supported_version" value="{{ old('min_supported_version') }}" class="border rounded w-full px-3 py-2" placeholder="1.0.0">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Changelog (one per line)</label>
            <textarea name="changelog" class="border rounded w-full px-3 py-2" rows="4" placeholder="Bug fixes&#10;New features&#10;Performance improvements">{{ old('changelog') }}</textarea>
        </div>

        <div class="flex gap-6 mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="is_critical" value="1" {{ old('is_critical') ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Is Critical (Security Update)</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="force_update" value="1" {{ old('force_update') ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Force Update</span>
            </label>
            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="mr-2">
                <span class="text-gray-700 text-sm font-bold">Is Active</span>
            </label>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create Version</button>
            <a href="{{ route('admin.versions.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
