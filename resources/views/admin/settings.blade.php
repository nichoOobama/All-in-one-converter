@extends('admin.layouts.admin')

@section('title', 'Settings')

@section('content')
<h1 class="text-2xl font-bold mb-6">Settings</h1>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <h2 class="text-lg font-bold mb-4">Conversion Limits</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Daily Limit per User</label>
                <input type="number" name="limits[per_user_daily]" value="{{ $settings['limits']['per_user_daily'] }}" class="border rounded w-full px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">Max File Size (MB)</label>
                <input type="number" name="limits[max_file_size_mb]" value="{{ $settings['limits']['max_file_size_mb'] }}" class="border rounded w-full px-3 py-2">
            </div>
        </div>

        <h2 class="text-lg font-bold mb-4">Temp Files</h2>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Lifetime (hours)</label>
            <input type="number" name="temp_lifetime_hours" value="{{ $settings['temp_lifetime_hours'] }}" class="border rounded w-full px-3 py-2">
        </div>

        <h2 class="text-lg font-bold mb-4">System Tools</h2>
        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">FFmpeg Path</label>
                <input type="text" name="drivers[ffmpeg]" value="{{ $settings['drivers']['ffmpeg'] }}" class="border rounded w-full px-3 py-2">
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2">LibreOffice Path</label>
                <input type="text" name="drivers[libreoffice]" value="{{ $settings['drivers']['libreoffice'] }}" class="border rounded w-full px-3 py-2">
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Settings</button>
    </form>
</div>
@endsection
