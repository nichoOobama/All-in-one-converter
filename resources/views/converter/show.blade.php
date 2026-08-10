@extends(Auth::check() ? 'layouts.app' : 'layouts.landing')
@section('content')

<!-- Main Content -->
<main class="flex-grow w-full max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-stack-lg gap-4">
        <div>
            <a class="flex items-center text-secondary hover:text-primary mb-2 transition-colors" href="{{ route('convert.index') }}">
                <span class="material-symbols-outlined mr-1 text-sm">arrow_back</span>
                <span class="font-label-sm text-label-sm">Back to Converter</span>
            </a>
            <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg">Conversion Status</h1>
        </div>

        <!-- Overall Status Badge -->
        <div id="status-badge"
             class="px-4 py-2 rounded-full flex items-center border
                @if ($conversion->isCompleted()) bg-primary-container/10 text-primary-container border-primary-container/20
                @elseif ($conversion->isFailed()) bg-error-container text-error border-error/20
                @else bg-primary-container/10 text-primary-container border-primary-container/20
                @endif">
            <span id="status-badge-icon"
                  class="material-symbols-outlined mr-2 text-sm @if ($conversion->isProcessing() || $conversion->isPending()) animate-spin @endif"
                  style="font-variation-settings: 'FILL' 1;">
                @if ($conversion->isCompleted()) check_circle
                @elseif ($conversion->isFailed()) error
                @else sync
                @endif
            </span>
            <span id="status-badge-label" class="font-label-md text-label-md">{{ ucfirst($conversion->status->value) }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
        <!-- Left Column: Status Card -->
        <div class="lg:col-span-2 space-y-stack-md">

            <!-- Active Conversion Card -->
            <div id="progress-section"
                 class="bg-surface-container-lowest border border-outline-variant rounded-xl p-gutter shadow-[0px_4px_12px_rgba(0,0,0,0.03)]"
                 @if (!$conversion->isPending() && !$conversion->isProcessing()) style="display: none;" @endif>
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-surface-container p-3 rounded-lg text-primary">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">description</span>
                        </div>
                        <div>
                            <h2 class="font-headline-md text-headline-md">Converting...</h2>
                            <p class="text-secondary font-body-sm text-body-sm">{{ $conversion->source_filename }}</p>
                        </div>
                    </div>
                </div>
                <!-- Progress Bar (indeterminate — no percentage reported by the backend) -->
                <div class="w-full bg-surface-container-high rounded-full h-2 mb-4 overflow-hidden">
                    <div class="bg-primary h-2 rounded-full progress-bar-animated" style="width: 100%"></div>
                </div>
                <p id="status-note" class="text-center text-secondary font-body-sm text-body-sm italic">checking status...</p>
            </div>

            <!-- File Information Details Table -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-[0px_4px_12px_rgba(0,0,0,0.03)]">
                <div class="px-gutter py-4 border-b border-outline-variant bg-surface">
                    <h3 class="font-label-md text-label-md text-on-surface">File Information</h3>
                </div>
                <div class="divide-y divide-outline-variant">
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">UUID</span>
                        <span class="font-label-sm text-label-sm font-mono text-on-surface">{{ $conversion->uuid }}</span>
                    </div>
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">Source Format</span>
                        <span class="font-label-sm text-label-sm font-mono bg-surface-container px-2 py-1 rounded">{{ strtoupper($conversion->source_extension) }}</span>
                    </div>
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">Target Format</span>
                        <span class="font-label-sm text-label-sm font-mono bg-surface-container px-2 py-1 rounded">{{ strtoupper($conversion->target_extension) }}</span>
                    </div>
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">Category</span>
                        <span class="font-body-sm text-body-sm">{{ $conversion->category }}</span>
                    </div>
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">Status</span>
                        <span class="font-body-sm text-body-sm">
                            <strong id="status-value">{{ $conversion->status->value }}</strong>
                        </span>
                    </div>
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">Source Size</span>
                        <span class="font-body-sm text-body-sm">{{ round($conversion->source_size / 1024, 2) }} KB</span>
                    </div>
                    <div id="output-size-row" class="flex justify-between px-gutter py-3" @if (!$conversion->output_size) style="display: none;" @endif>
                        <span class="text-secondary font-body-sm text-body-sm">Output Size</span>
                        <span id="output-size" class="font-body-sm text-body-sm">@if ($conversion->output_size) {{ round($conversion->output_size / 1024, 2) }} KB @endif</span>
                    </div>
                    <div id="duration-row" class="flex justify-between px-gutter py-3" @if (!$conversion->duration_ms) style="display: none;" @endif>
                        <span class="text-secondary font-body-sm text-body-sm">Duration</span>
                        <span id="duration" class="font-body-sm text-body-sm">@if ($conversion->duration_ms) {{ $conversion->duration_ms }} ms @endif</span>
                    </div>
                    <div id="error-row" class="flex justify-between px-gutter py-3" @if (!$conversion->error_message) style="display: none;" @endif>
                        <span class="text-secondary font-body-sm text-body-sm">Error</span>
                        <span id="error-message" class="font-body-sm text-body-sm text-error text-right">{{ $conversion->error_message }}</span>
                    </div>
                    <div class="flex justify-between px-gutter py-3">
                        <span class="text-secondary font-body-sm text-body-sm">Created At</span>
                        <span class="font-body-sm text-body-sm">{{ $conversion->created_at->format('Y-m-d H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Actions -->
        <div class="space-y-stack-md">

            <!-- Completed Actions -->
            <div id="completed-actions"
                 class="bg-surface-container-lowest border border-outline-variant rounded-xl p-gutter shadow-[0px_4px_12px_rgba(0,0,0,0.03)] flex flex-col gap-4"
                 @if (!$conversion->isCompleted()) style="display: none;" @endif>
                <a href="{{ route('convert.download', $conversion->uuid) }}" class="w-full">
                    <button type="button" class="w-full bg-primary text-on-primary font-label-md text-label-md py-3 px-6 rounded-lg flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-sm">download</span>
                        Download Converted File
                    </button>
                </a>

                <form action="{{ route('convert.destroy', $conversion->uuid) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this conversion?')"
                            class="w-full bg-transparent border border-outline text-error font-label-md text-label-md py-3 px-6 rounded-lg flex items-center justify-center gap-2 hover:bg-error-container transition-colors">
                        <span class="material-symbols-outlined text-sm">delete</span>
                        Delete
                    </button>
                </form>
            </div>

            <!-- Failed Actions -->
            <div id="failed-actions"
                 class="bg-surface-container-lowest border border-outline-variant rounded-xl p-gutter shadow-[0px_4px_12px_rgba(0,0,0,0.03)] flex flex-col gap-4"
                 @if (!$conversion->isFailed()) style="display: none;" @endif>
                <a href="{{ route('convert.index') }}" class="w-full">
                    <button type="button" class="w-full bg-primary text-on-primary font-label-md text-label-md py-3 px-6 rounded-lg flex items-center justify-center gap-2 hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-sm">refresh</span>
                        Try Again
                    </button>
                </a>
            </div>

            <!-- In-progress Actions (disabled state) -->
            <div id="pending-actions"
                 class="bg-surface-container-lowest border border-outline-variant rounded-xl p-gutter shadow-[0px_4px_12px_rgba(0,0,0,0.03)] flex flex-col gap-4 opacity-75"
                 @if (!$conversion->isPending() && !$conversion->isProcessing()) style="display: none;" @endif>
                <button class="w-full bg-outline-variant text-on-surface-variant font-label-md text-label-md py-3 px-6 rounded-lg flex items-center justify-center gap-2 cursor-not-allowed" disabled="">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Download Converted File
                </button>
            </div>

            <!-- Promotional / Tool Suggestion -->
            <div class="bg-surface-container-low border border-primary-fixed-dim rounded-xl p-gutter">
                <h4 class="font-label-md text-label-md text-on-surface mb-2">Need to merge PDFs?</h4>
                <p class="text-secondary font-body-sm text-body-sm mb-4">Combine multiple PDF documents into one seamless file with our free tool.</p>
                <a class="text-primary font-label-md text-label-md flex items-center gap-1 hover:underline" href="#">
                    Try PDF Merger <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>
        </div>
    </div>
</main>

@push('script')
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
    const pendingActions = document.getElementById('pending-actions');
    const progressSection = document.getElementById('progress-section');
    const statusBadge = document.getElementById('status-badge');
    const statusBadgeIcon = document.getElementById('status-badge-icon');
    const statusBadgeLabel = document.getElementById('status-badge-label');

    function stopPolling() {
        clearInterval(pollId);
        if (statusNote) statusNote.style.display = 'none';
        if (progressSection) progressSection.style.display = 'none';
        if (pendingActions) pendingActions.style.display = 'none';
    }

    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }

    function updateBadge(status) {
        if (!statusBadge) return;
        statusBadge.classList.remove(
            'bg-primary-container/10', 'text-primary-container', 'border-primary-container/20',
            'bg-error-container', 'text-error', 'border-error/20'
        );
        statusBadgeIcon.classList.remove('animate-spin');

        if (status === 'completed') {
            statusBadge.classList.add('bg-primary-container/10', 'text-primary-container', 'border-primary-container/20');
            statusBadgeIcon.textContent = 'check_circle';
        } else if (status === 'failed') {
            statusBadge.classList.add('bg-error-container', 'text-error', 'border-error/20');
            statusBadgeIcon.textContent = 'error';
        } else {
            statusBadge.classList.add('bg-primary-container/10', 'text-primary-container', 'border-primary-container/20');
            statusBadgeIcon.textContent = 'sync';
            statusBadgeIcon.classList.add('animate-spin');
        }
        statusBadgeLabel.textContent = capitalize(status);
    }

    function render(data) {
        statusValue.textContent = data.status;
        updateBadge(data.status);

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
@endpush
@endsection