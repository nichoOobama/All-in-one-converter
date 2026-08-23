@extends('layouts.app')

@section('title', 'License Detail')

@section('content')
<!-- Main Content Canvas -->
<main class="flex-grow max-w-container-max w-full mx-auto px-margin-mobile md:px-margin-desktop py-stack-lg">
<!-- Header & Back Link -->
<div class="mb-stack-lg">
<a class="inline-flex items-center gap-unit text-primary hover:underline font-label-md text-label-md mb-stack-sm" href="{{ route('licenses') }}">
<span class="material-symbols-outlined" style="font-size: 16px;">arrow_back</span>
                Back to My Licenses
            </a>
<h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-surface">License Detail</h1>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Left Column: License Card -->
<div class="lg:col-span-8 flex flex-col gap-stack-md">
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-gutter shadow-[0px_4px_12px_rgba(0,0,0,0.03)] relative overflow-hidden">
<!-- Subtle Accent Bar -->
<div class="absolute top-0 left-0 w-full h-1 bg-primary"></div>
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-stack-md gap-stack-sm">
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">License Key</p>
<div class="flex items-center gap-stack-sm">
<code class="font-display text-headline-md md:text-display text-primary bg-surface-container px-3 py-1 rounded font-mono tracking-tight" id="license-key">{{ $license->license_key }}</code>
        @if ($license->isActive())
        <button aria-label="Copy License Key" class="p-2 text-secondary hover:text-primary bg-surface-container hover:bg-surface-variant rounded transition-colors group relative" onclick="copyLicense()">
        <span class="material-symbols-outlined text-[20px]">content_copy</span>
        <!-- Tooltip -->
        <span class="absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface font-label-sm text-label-sm px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Copy Key</span>
        </button>
        @endif
</div>
<p class="font-body-sm text-body-sm text-secondary mt-2 flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">info</span>
                                Copy this key and enter it in the native app
                            </p>
</div>
<div class="bg-surface-variant text-primary-container px-3 py-1 rounded-full font-label-md text-label-md flex items-center gap-1">
<span class="material-symbols-outlined" style="font-size: 16px; font-variation-settings: 'FILL' 1;">check_circle</span>
                            Active
                        </div>
</div>
<div class="grid grid-cols-2 md:grid-cols-4 gap-stack-md pt-stack-md border-t border-outline-variant">
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Type</p>
<p class="font-body-md text-body-md text-on-surface font-semibold">{{ ucfirst($license->type) }}</p>
</div>
<div>
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Status</p>
<p class="font-body-md text-body-md text-on-surface">{{ $license->status }}</p>
 @if ($license->isUsed())
              <p class="font-body-md text-body-md text-on-surface">  - Used on {{ $license->used_at->format('Y-m-d H:i') }}</p>
            @endif
<p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Purchased At</p>
 @if ($license->expires_at)
        <p class="font-label-sm text-label-sm text-on-surface-variant mb-1">Expires At</p>
            <p class="font-body-md text-body-md text-on-surface">{{ $license->expires_at->format('Y-m-d') }}</p>
    @endif
</div>
</div>
</div>
@if ($license->isActive())
   <!-- Right Column: Instructions -->
<div class="lg:col-span-4">
<div class="bg-surface-container-lowest border border-outline-variant rounded-lg p-gutter shadow-[0px_4px_12px_rgba(0,0,0,0.03)] h-full">
<h2 class="font-headline-md text-headline-md text-on-surface mb-stack-md flex items-center gap-unit">
<span class="material-symbols-outlined text-primary">integration_instructions</span>
                        How to Activate
                    </h2>
<ol class="space-y-stack-md relative before:absolute before:inset-y-0 before:left-[11px] before:w-[2px] before:bg-surface-container-highest">
<li class="relative pl-8">
<span class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm z-10 border-2 border-surface-container-lowest">1</span>
<p class="font-body-md text-body-md text-on-surface">Open the native app</p>
<p class="font-body-sm text-body-sm text-secondary">Available on Windows or Android.</p>
</li>
<li class="relative pl-8">
<span class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm z-10 border-2 border-surface-container-lowest">2</span>
<p class="font-body-md text-body-md text-on-surface">Navigate to Settings</p>
<p class="font-body-sm text-body-sm text-secondary">Find the <strong>License Activation</strong> section in the settings menu.</p>
</li>
<li class="relative pl-8">
<span class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm z-10 border-2 border-surface-container-lowest">3</span>
<p class="font-body-md text-body-md text-on-surface">Enter Key</p>
<p class="font-body-sm text-body-sm text-secondary">Paste the license key copied from this page.</p>
</li>
<li class="relative pl-8">
<span class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-sm text-label-sm z-10 border-2 border-surface-container-lowest">4</span>
<p class="font-body-md text-body-md text-on-surface">Click Activate</p>
<p class="font-body-sm text-body-sm text-secondary">Your app will verify the key and unlock Pro features. <strong>Note:</strong>This license can only be used once. After activation, it cannot be used on another device.</p>
</li>
</ol>
</div>
</div>
@endif
@if ($license->isUsed())
    <h2>Activation Details</h2>
    <p>This license was activated on: <strong>{{ $license->used_at->format('Y-m-d H:i:s') }}</strong></p>
    <p>Since this is a single-use license, it cannot be used again.</p>
@endif
</div>
</div>
</div>
</div>
</main>
@endsection
