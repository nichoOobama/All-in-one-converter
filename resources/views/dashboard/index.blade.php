@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="flex-grow flex max-w-container-max w-full mx-auto px-margin-desktop py-stack-lg gap-gutter">
@include('layouts.sidebar')
<!-- Main Content -->
<main class="flex-grow flex flex-col gap-stack-lg">
<!-- Welcome Header -->
<section class="flex flex-col gap-stack-sm">
<h1 class="font-headline-lg text-headline-lg text-on-surface">Welcome back, Alex.</h1>
<!-- Recent Activity Table -->
<section class="tonal-layer rounded-xl overflow-hidden">
<div class="px-gutter py-stack-md border-b border-outline-variant flex justify-between items-center bg-surface-container-low">
<h2 class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Recent Activity</h2>
<button class="text-primary font-label-md text-label-md hover:underline">View All History</button>
</div>
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="font-label-sm text-label-sm text-secondary border-b border-outline-variant">
<th class="px-gutter py-stack-sm font-medium">File Name</th>
<th class="px-gutter py-stack-sm font-medium">Type</th>
<th class="px-gutter py-stack-sm font-medium">Status</th>
<th class="px-gutter py-stack-sm font-medium">Date</th>
<th class="px-gutter py-stack-sm font-medium text-right">Action</th>
</tr>
</thead>
<tbody class="font-body-sm text-body-sm">
<tr class="hover:bg-surface-container-lowest transition-colors border-b border-outline-variant">
<td class="px-gutter py-stack-sm text-on-surface font-medium">invoice_2023_dec.pdf</td>
<td class="px-gutter py-stack-sm text-secondary">PDF → XLSX</td>
<td class="px-gutter py-stack-sm">
<span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold">Success</span>
</td>
<td class="px-gutter py-stack-sm text-secondary">2 mins ago</td>
<td class="px-gutter py-stack-sm text-right">
<button class="text-primary material-symbols-outlined">download</button>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest transition-colors border-b border-outline-variant">
<td class="px-gutter py-stack-sm text-on-surface font-medium">product_shoot_01.heic</td>
<td class="px-gutter py-stack-sm text-secondary">HEIC → JPG</td>
<td class="px-gutter py-stack-sm">
<span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold">Success</span>
</td>
<td class="px-gutter py-stack-sm text-secondary">1 hour ago</td>
<td class="px-gutter py-stack-sm text-right">
<button class="text-primary material-symbols-outlined">download</button>
</td>
</tr>
<tr class="hover:bg-surface-container-lowest transition-colors border-b border-outline-variant">
<td class="px-gutter py-stack-sm text-on-surface font-medium">annual_report_draft.docx</td>
<td class="px-gutter py-stack-sm text-secondary">DOCX → PDF</td>
<td class="px-gutter py-stack-sm">
<span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-bold">Processing</span>
</td>
<td class="px-gutter py-stack-sm text-secondary">Just now</td>
<td class="px-gutter py-stack-sm text-right">
<button class="text-outline material-symbols-outlined cursor-not-allowed">pending</button>
</td>
</tr>
</tbody>
</table>
</div>
</section>
</main>
</div>

<!-- Welcome Header -->

<!-- <h1>Dashboard</h1>
<p>Welcome, {{ auth()->user()->name }}!</p>

<h2>Quick Links</h2>
<ul>
    <li><a href="{{ route('convert.index') }}">File Converter</a></li>
    <li><a href="{{ route('download') }}">Download Native Apps</a></li>
    <li><a href="{{ route('pricing') }}">Buy License</a></li>
    <li><a href="{{ route('licenses') }}">My Licenses ({{ $licenses->count() }})</a></li>
</ul>

@if ($licenses->where('status', 'active')->count() > 0)
    <h2>Active Licenses</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Key</th>
                <th>Type</th>
                <th>Status</th>
                <th>Expires</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($licenses->where('status', 'active') as $license)
                <tr>
                    <td>{{ $license->license_key }}</td>
                    <td>{{ ucfirst($license->type) }}</td>
                    <td>{{ $license->status }}</td>
                    <td>{{ $license->expires_at ? $license->expires_at->format('Y-m-d') : 'Lifetime' }}</td>
                    <td><a href="{{ route('licenses.show', $license->license_key) }}">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif -->
@endsection
