@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold text-slate-900 mb-6">Dashboard</h1>

<!-- Stats Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-start justify-between">
        <div>
            <h3 class="text-slate-500 text-sm font-medium">Total Users</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_users'] }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4"/>
            </svg>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-start justify-between">
        <div>
            <h3 class="text-slate-500 text-sm font-medium">Total Conversions</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_conversions'] }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-start justify-between">
        <div>
            <h3 class="text-slate-500 text-sm font-medium">Total Licenses</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_licenses'] }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
            </svg>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-start justify-between">
        <div>
            <h3 class="text-slate-500 text-sm font-medium">Total Versions</h3>
            <p class="text-3xl font-bold text-slate-900 mt-1">{{ $stats['total_versions'] }}</p>
        </div>
        <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
            </svg>
        </div>
    </div>
</div>

<!-- Highlight Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-blue-600 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <div>
            <h3 class="text-slate-500 text-sm font-medium">Today's Conversions</h3>
            <p class="text-3xl font-bold text-blue-600">{{ $stats['conversions_today'] }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg bg-emerald-600 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 12v-2m0-8c-1.11 0-2.08.402-2.599 1"/>
            </svg>
        </div>
        <div>
            <h3 class="text-slate-500 text-sm font-medium">Revenue (Licenses)</h3>
            <p class="text-3xl font-bold text-emerald-600">${{ number_format($stats['revenue'], 2) }}</p>
        </div>
    </div>
</div>

<!-- Recent Conversions -->
<div class="bg-white rounded-xl shadow-sm border border-slate-100 mb-8 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Recent Conversions</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                    <th class="text-left px-5 py-3 font-medium">UUID</th>
                    <th class="text-left px-5 py-3 font-medium">File</th>
                    <th class="text-left px-5 py-3 font-medium">Category</th>
                    <th class="text-left px-5 py-3 font-medium">Status</th>
                    <th class="text-left px-5 py-3 font-medium">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($recentConversions as $conversion)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-slate-500">{{ substr($conversion['uuid'], 0, 8) }}...</td>
                        <td class="px-5 py-3 text-slate-800">{{ $conversion['filename'] }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $conversion['category'] }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $conversion['status'] === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($conversion['status'] === 'failed' ? 'bg-red-100 text-red-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ $conversion['status'] }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-slate-500">{{ $conversion['created_at'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-8 text-center text-slate-400">No conversions yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Users -->
<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="px-5 py-4 border-b border-slate-100">
        <h2 class="text-base font-semibold text-slate-900">Recent Users</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wide">
                    <th class="text-left px-5 py-3 font-medium">Name</th>
                    <th class="text-left px-5 py-3 font-medium">Email</th>
                    <th class="text-left px-5 py-3 font-medium">Role</th>
                    <th class="text-left px-5 py-3 font-medium">Joined</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($recentUsers as $user)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-5 py-3 text-slate-800 font-medium">{{ $user->name }}</td>
                        <td class="px-5 py-3 text-slate-600">{{ $user->email }}</td>
                        <td class="px-5 py-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-700' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-slate-500">{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-8 text-center text-slate-400">No users yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection