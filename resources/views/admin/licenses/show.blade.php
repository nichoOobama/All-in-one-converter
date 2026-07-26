@extends('admin.layouts.admin')

@section('title', 'License Detail')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">License Detail</h1>
    <a href="{{ route('admin.licenses.index') }}" class="text-blue-500 hover:underline">Back to Licenses</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="text-gray-500 text-sm">ID</label>
            <p class="font-semibold">{{ $license->id }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">License Key</label>
            <p class="font-mono text-lg">{{ $license->license_key }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">User</label>
            <p>{{ $license->user->name ?? '-' }} ({{ $license->user->email ?? '-' }})</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Type</label>
            <p>{{ ucfirst($license->type) }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Status</label>
            <p>
                <span class="px-2 py-1 rounded text-xs {{ $license->status === 'active' ? 'bg-green-100 text-green-800' : ($license->status === 'used' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                    {{ $license->status }}
                </span>
            </p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Used At</label>
            <p>{{ $license->used_at ? $license->used_at->format('Y-m-d H:i:s') : '-' }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Expires At</label>
            <p>{{ $license->expires_at ? $license->expires_at->format('Y-m-d') : 'Lifetime' }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Created At</label>
            <p>{{ $license->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <div class="mt-6">
        <form action="{{ route('admin.licenses.destroy', $license->id) }}" method="POST" onsubmit="return confirm('Delete this license?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete License</button>
        </form>
    </div>
</div>
@endsection
