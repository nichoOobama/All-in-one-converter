@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h1>Dashboard</h1>
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
@endif
@endsection
