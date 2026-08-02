<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion Status - All-in-One Converter</title>
    <style>
        .progress-track {
            height: 14px;
            background: #e5e7eb;
            border-radius: 7px;
            overflow: hidden;
            position: relative;
        }
        .progress-bar {
            height: 100%;
            width: 35%;
            border-radius: 7px;
            background: #4f46e5;
            animation: indeterminate 1.4s infinite ease-in-out;
        }
        @keyframes indeterminate {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(350%); }
        }
    </style>
</head>
<body>
    <h1>Conversion Status</h1>

    <a href="{{ route('convert.index') }}">Back to Converter</a>

    <hr>

    <div id="progress-section" @if (!$conversion->isPending() && !$conversion->isProcessing()) style="display: none;" @endif>
        <p><strong>Converting...</strong></p>
        <div class="progress-track">
            <div class="progress-bar"></div>
        </div>
        <br>
    </div>

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
                <strong id="status-value">{{ $conversion->status->value }}</strong>
                @if ($conversion->isProcessing() || $conversion->isPending())
                    <span id="status-note">(checking status...)</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Source Size</th>
            <td>{{ round($conversion->source_size / 1024, 2) }} KB</td>
        </tr>
        <tr id="output-size-row" @if (!$conversion->output_size) style="display: none;" @endif>
            <th>Output Size</th>
            <td id="output-size">@if ($conversion->output_size) {{ round($conversion->output_size / 1024, 2) }} KB @endif</td>
        </tr>
        <tr id="duration-row" @if (!$conversion->duration_ms) style="display: none;" @endif>
            <th>Duration</th>
            <td id="duration">@if ($conversion->duration_ms) {{ $conversion->duration_ms }} ms @endif</td>
        </tr>
        <tr id="error-row" @if (!$conversion->error_message) style="display: none;" @endif>
            <th>Error</th>
            <td style="color: red;" id="error-message">{{ $conversion->error_message }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $conversion->created_at->format('Y-m-d H:i:s') }}</td>
        </tr>
    </table>

    <div id="completed-actions" @if (!$conversion->isCompleted()) style="display: none;" @endif>
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
    </div>

    <div id="failed-actions" @if (!$conversion->isFailed()) style="display: none;" @endif>
        <br>
        <a href="{{ route('convert.index') }}">Try Again</a>
    </div>

    <script>
        const statusUrl = "{{ route('api.convert.status', $conversion->uuid) }}";
        const initialStatus = "{{ $conversion->status->value }}";
        const terminal = ['completed', 'failed'];
        let pollId = null;

        const statusValue = document.getElementById('status-value');
        const statusNote = document.getElementById('status-note');
        const outputSizeRow = document.getElementById('output-size-row');
        const outputSize = document.getElementById('output-size');
        const durationRow = document.getElementById('duration-row');
        const duration = document.getElementById('duration');
        const errorRow = document.getElementById('error-row');
        const errorMessage = document.getElementById('error-message');
        const completedActions = document.getElementById('completed-actions');
        const failedActions = document.getElementById('failed-actions');
        const progressSection = document.getElementById('progress-section');

        function stopPolling() {
            clearInterval(pollId);
            if (statusNote) statusNote.style.display = 'none';
            if (progressSection) progressSection.style.display = 'none';
        }

        function render(data) {
            statusValue.textContent = data.status;

            if (data.status === 'completed') {
                if (data.output_size != null) {
                    outputSize.textContent = (data.output_size / 1024).toFixed(2) + ' KB';
                    outputSizeRow.style.display = '';
                }
                if (data.duration_ms != null) {
                    duration.textContent = data.duration_ms + ' ms';
                    durationRow.style.display = '';
                }
                completedActions.style.display = '';
                stopPolling();
            } else if (data.status === 'failed') {
                errorMessage.textContent = data.error_message || 'Unknown error';
                errorRow.style.display = '';
                failedActions.style.display = '';
                stopPolling();
            }
        }

        async function poll() {
            try {
                const response = await fetch(statusUrl);
                const json = await response.json();
                if (json.success) render(json.data);
            } catch (e) {
                // transient network error — keep polling
            }
        }

        if (!terminal.includes(initialStatus)) {
            pollId = setInterval(poll, 3000);
            poll();
        }
    </script>
</body>
</html>
