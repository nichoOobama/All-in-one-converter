@extends('layouts.app')

@section('title', 'My Licenses')

@section('content')
<main class=" flex max-w-container-max w-full mx-auto px-margin-desktop py-stack-lg gap-2">
    <h1>My Licenses</h1>

@if ($licenses->isEmpty())
    <p>You don't have any licenses yet.</p>
    <a href="{{ route('pricing') }}">
        <button type="button" class="text-on-primary-fixed-variant hover:underline">Buy Your First License</button>
    </a>
@else
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>License Key</th>
                <th>Type</th>
                <th>Status</th>
                <th>Used At</th>
                <th>Expires</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($licenses as $license)
                <tr>
                    <td>
                        @if ($license->isActive())
                            {{ $license->license_key }}
                        @else
                            <em>Used / Expired</em>
                        @endif
                    </td>
                    <td>{{ ucfirst($license->type) }}</td>
                    <td>{{ $license->status }}</td>
                    <td>{{ $license->used_at ? $license->used_at->format('Y-m-d H:i') : '-' }}</td>
                    <td>{{ $license->expires_at ? $license->expires_at->format('Y-m-d') : 'Lifetime' }}</td>
                    <td>
                        <a href="{{ route('licenses.show', $license->license_key) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</main>
@endsection
