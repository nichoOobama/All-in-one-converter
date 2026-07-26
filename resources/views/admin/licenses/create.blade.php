@extends('admin.layouts.admin')

@section('title', 'Create License')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Create License</h1>
    <a href="{{ route('admin.licenses.index') }}" class="text-blue-500 hover:underline">Back to Licenses</a>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.licenses.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">User</label>
            <select name="user_id" class="border rounded w-full px-3 py-2" required>
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">License Type</label>
            <select name="type" class="border rounded w-full px-3 py-2" required>
                <option value="single">Single Purchase ($9.99)</option>
                <option value="subscription">Subscription ($4.99/month)</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Expires At (optional, for subscription)</label>
            <input type="date" name="expires_at" class="border rounded w-full px-3 py-2">
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Create License</button>
            <a href="{{ route('admin.licenses.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
