@extends('admin.layouts.admin')

@section('title', 'Settings')

@section('content')
<h1 class="text-2xl font-bold text-slate-900 mb-6">Settings</h1>

<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Conversion Limits -->
        <div class="p-6 border-b border-slate-100">
            <div class="flex items-center gap-2 mb-5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-slate-900">Conversion Limits</h2>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-600 text-sm font-medium mb-1.5">Daily Limit per User</label>
                    <input type="number" name="limits[per_user_daily]" value="{{ $settings['limits']['per_user_daily'] }}" class="border border-slate-200 rounded-lg w-full px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-slate-600 text-sm font-medium mb-1.5">Max File Size (MB)</label>
                    <input type="number" name="limits[max_file_size_mb]" value="{{ $settings['limits']['max_file_size_mb'] }}" class="border border-slate-200 rounded-lg w-full px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Temp Files -->
        <div class="p-6 border-b border-slate-100">
            <div class="flex items-center gap-2 mb-5">
                <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-slate-900">Temp Files</h2>
            </div>
            <div class="max-w-xs">
                <label class="block text-slate-600 text-sm font-medium mb-1.5">Lifetime (hours)</label>
                <input type="number" name="temp_lifetime_hours" value="{{ $settings['temp_lifetime_hours'] }}" class="border border-slate-200 rounded-lg w-full px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </div>

        <!-- System Tools -->
        <div class="p-6 border-b border-slate-100">
            <div class="flex items-center gap-2 mb-5">
                <div class="w-8 h-8 rounded-lg bg-purple-50 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h2 class="text-base font-semibold text-slate-900">System Tools</h2>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-600 text-sm font-medium mb-1.5">FFmpeg Path</label>
                    <input type="text" name="drivers[ffmpeg]" value="{{ $settings['drivers']['ffmpeg'] }}" class="border border-slate-200 rounded-lg w-full px-3 py-2 text-sm text-slate-700 font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-slate-600 text-sm font-medium mb-1.5">LibreOffice Path</label>
                    <input type="text" name="drivers[libreoffice]" value="{{ $settings['drivers']['libreoffice'] }}" class="border border-slate-200 rounded-lg w-full px-3 py-2 text-sm text-slate-700 font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="px-6 py-4 bg-slate-50 flex justify-end">
            <button type="submit" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection