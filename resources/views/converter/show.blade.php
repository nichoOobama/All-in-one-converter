<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion Status - All-in-One Converter</title>
    <meta http-equiv="refresh" content="{{ $conversion->isProcessing() || $conversion->isPending() ? '3' : '0' }}">
</head>
<body>
    <h1>Conversion Status</h1>

    <a href="{{ route('convert.index') }}">Back to Converter</a>

    <hr>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>UUID</th>
            <td>{{ $conversion->uuid }}</td>
        </tr>
        <tr>
            <th>Source File</th>
            <td>{{ $conversion->source_filename }}</td>
        </tr>
        <tr>
            <th>Source Format</th>
            <td>{{ strtoupper($conversion->source_extension) }}</td>
        </tr>
        <tr>
            <th>Target Format</th>
            <td>{{ strtoupper($conversion->target_extension) }}</td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $conversion->category }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                <strong>{{ $conversion->status->value }}</strong>
                @if ($conversion->isProcessing() || $conversion->isPending())
                    (auto-refreshing every 3 seconds)
                @endif
            </td>
        </tr>
        <tr>
            <th>Source Size</th>
            <td>{{ round($conversion->source_size / 1024, 2) }} KB</td>
        </tr>
        @if ($conversion->output_size)
            <tr>
                <th>Output Size</th>
                <td>{{ round($conversion->output_size / 1024, 2) }} KB</td>
            </tr>
        @endif
        @if ($conversion->duration_ms)
            <tr>
                <th>Duration</th>
                <td>{{ $conversion->duration_ms }} ms</td>
            </tr>
        @endif
        @if ($conversion->error_message)
            <tr>
                <th>Error</th>
                <td style="color: red;">{{ $conversion->error_message }}</td>
            </tr>
        @endif
        <tr>
            <th>Created At</th>
            <td>{{ $conversion->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>

    @if ($conversion->isCompleted())
        <br>
        <a href="{{ route('convert.download', $conversion->uuid) }}">
            <button type="button">Download Converted File</button>
        </a>

        <form action="{{ route('convert.destroy', $conversion->uuid) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete this conversion?')">
                Delete
            </button>
        </form>
    @endif

    @if ($conversion->isFailed())
        <br>
        <a href="{{ route('convert.index') }}">Try Again</a>
    @endif
</body>
</html>
