@extends('layouts.app')

@section('title', 'License Detail')

@section('content')
<h1>License Detail</h1>

<a href="{{ route('licenses') }}">Back to My Licenses</a>

<hr>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>License Key</th>
        <td>
            <strong>{{ $license->license_key }}</strong>
            @if ($license->isActive())
                <small>(Copy this key and enter it in the native app)</small>
            @endif
        </td>
    </tr>
    <tr>
        <th>Type</th>
        <td>{{ ucfirst($license->type) }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <strong>{{ $license->status }}</strong>
            @if ($license->isUsed())
                - Used on {{ $license->used_at->format('Y-m-d H:i') }}
            @endif
        </td>
    </tr>
    <tr>
        <th>Purchased At</th>
        <td>{{ $license->created_at->format('Y-m-d H:i') }}</td>
    </tr>
    @if ($license->expires_at)
        <tr>
            <th>Expires At</th>
            <td>{{ $license->expires_at->format('Y-m-d') }}</td>
        </tr>
    @endif
</table>

@if ($license->isActive())
    <h2>How to Activate</h2>
    <ol>
        <li>Open the native app (Windows or Android)</li>
        <li>Go to Settings > License Activation</li>
        <li>Enter the license key above</li>
        <li>Click Activate</li>
    </ol>

    <p><strong>Note:</strong> This license can only be used once. After activation, it cannot be used on another device.</p>
@endif

@if ($license->isUsed())
    <h2>Activation Details</h2>
    <p>This license was activated on: <strong>{{ $license->used_at->format('Y-m-d H:i:s') }}</strong></p>
    <p>Since this is a single-use license, it cannot be used again.</p>
@endif
@endsection
