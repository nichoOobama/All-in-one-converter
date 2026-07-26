@extends('admin.layouts.admin')

@section('title', 'Conversion Detail')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Conversion Detail</h1>
    <a href="{{ route('admin.conversions.index') }}" class="text-blue-500 hover:underline">Back to Conversions</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <div class="grid grid-cols-2 gap-6">
        <div>
            <label class="text-gray-500 text-sm">UUID</label>
            <p class="font-mono">{{ $conversion->uuid }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Status</label>
            <p>
                <span class="px-2 py-1 rounded text-xs {{ $conversion->status->value === 'completed' ? 'bg-green-100 text-green-800' : ($conversion->status->value === 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                    {{ $conversion->status->value }}
                </span>
            </p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Source File</label>
            <p>{{ $conversion->source_filename }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Source Extension</label>
            <p>{{ strtoupper($conversion->source_extension) }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Target Extension</label>
            <p>{{ strtoupper($conversion->target_extension) }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Category</label>
            <p>{{ $conversion->category }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Source Size</label>
            <p>{{ number_format($conversion->source_size / 1024, 2) }} KB</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Output Size</label>
            <p>{{ $conversion->output_size ? number_format($conversion->output_size / 1024, 2) . ' KB' : '-' }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Duration</label>
            <p>{{ $conversion->duration_ms ? $conversion->duration_ms . ' ms' : '-' }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">IP Address</label>
            <p>{{ $conversion->ip_address ?? '-' }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Created At</label>
            <p>{{ $conversion->created_at->format('Y-m-d H:i:s') }}</p>
        </div>
        <div>
            <label class="text-gray-500 text-sm">Output Path</label>
            <p class="font-mono text-xs">{{ $conversion->output_path ?? '-' }}</p>
        </div>
    </div>

    @if ($conversion->error_message)
        <div class="mt-4 p-4 bg-red-50 rounded">
            <label class="text-red-600 font-semibold">Error Message</label>
            <p class="text-red-700">{{ $conversion->error_message }}</p>
        </div>
    @endif

    @if ($conversion->options)
        <div class="mt-4 p-4 bg-gray-50 rounded">
            <label class="text-gray-600 font-semibold">Options</label>
            <pre class="text-sm">{{ json_encode($conversion->options, JSON_PRETTY_PRINT) }}</pre>
        </div>
    @endif

    <div class="mt-6">
        <form action="{{ route('admin.conversions.destroy', $conversion->id) }}" method="POST" onsubmit="return confirm('Delete this conversion?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
        </form>
    </div>
</div>
@endsection
