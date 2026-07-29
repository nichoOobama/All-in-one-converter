@extends('layouts.landing')

@section('title', 'Pricing')

@section('content')

<main class="max-w-container-max mx-auto px-margin-desktop py-stack-lg">
<!-- Header Section -->
<header class="text-center mb-stack-lg">
<h1 class="font-display text-display text-on-surface mb-stack-sm">Simple, Transparent Pricing</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto">Choose the perfect plan for your file conversion needs. From casual users to enterprise powerhouses.</p>
<!-- Monthly/Annual Toggle -->
<div class="mt-stack-lg flex items-center justify-center gap-stack-md" id="billing-toggle-container">
<span class="font-label-md text-label-md text-secondary" id="label-monthly">Monthly</span>
<button class="relative w-12 h-6 bg-secondary-container rounded-full p-1 flex items-center transition-colors" id="billing-toggle">
<div class="toggle-knob w-4 h-4 bg-primary rounded-full shadow-sm"></div>
</button>
<span class="font-label-md text-label-md text-secondary" id="label-annual">Annual <span class="text-primary font-bold">(Save 20%)</span></span>
</div>
</header>
<!-- Pricing Cards Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-20">
<!-- Free Plan -->
<div class="pricing-card bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col">
<div class="mb-stack-md">
<h3 class="font-headline-md text-headline-md text-on-surface">Free</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Best for occasional use</p>
</div>
<div class="mb-stack-lg">
<span class="font-display text-display text-on-surface">$0</span>
<span class="font-label-md text-label-md text-secondary">/ forever</span>
</div>
<ul class="flex-grow space-y-stack-sm mb-stack-lg">
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        5 conversions per day
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        10MB max file size
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Standard conversion speed
                    </li>
</ul>
<a href="{{route('convert.index')}}">
<button class="w-full py-3 rounded-lg border border-primary text-primary font-label-md text-label-md hover:bg-primary-container hover:text-white transition-all">Get Started</button>
</a>
</div>
<!-- Pro Plan (Highlighted) -->
<div class="pricing-card bg-surface-container-lowest border-2 border-primary rounded-xl p-stack-lg flex flex-col relative">
<div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white px-4 py-1 rounded-full text-label-sm font-label-sm">Most Popular</div>
<div class="mb-stack-md">
<h3 class="font-headline-md text-headline-md text-on-surface">Single Purchase</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">One-time payment. Lifetime access.</p>
</div>
<div class="mb-stack-lg">
<span class="font-display text-display text-on-surface price-val" data-annual="9" data-monthly="12">$9.99</span>
</div>
<ul class="flex-grow space-y-stack-sm mb-stack-lg">
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                Unlimited Conversions
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                       All file formats supported
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Batch processing
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                       Free updates
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        One device only
                    </li>
</ul>
<a href="{{ route('checkout', 'single') }}">
<button class="w-full py-3 rounded-lg bg-primary text-white font-label-md text-label-md hover:opacity-90 shadow-sm transition-all">Buy Now</button>
</a>
</div>
<!-- Enterprise Plan -->
<div class="pricing-card bg-surface-container-lowest border border-outline-variant rounded-xl p-stack-lg flex flex-col">
<div class="mb-stack-md">
<h3 class="font-headline-md text-headline-md text-on-surface">Subscription</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Monthly subscription. Cancel anytime.</p>
</div>
<div class="mb-stack-lg">
<span class="font-display text-display text-on-surface price-val" data-annual="39" data-monthly="49">$4.99</span>
<span class="font-label-md text-label-md text-secondary">/ month</span>
</div>
<ul class="flex-grow space-y-stack-sm mb-stack-lg">
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Everything in Single Purchase
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Multi-device support (up to 3 devices)
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Priority support
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Early access to new features
                    </li>
<li class="flex items-start gap-stack-sm font-body-sm text-body-sm text-on-surface">
<span class="material-symbols-outlined text-primary text-[20px]" data-icon="check_circle">check_circle</span>
                        Cloud sync (coming soon)
                    </li>
</ul>
<a href="{{ route('checkout', 'subscription') }}">
    <button class="w-full py-3 rounded-lg border border-secondary text-secondary font-label-md text-label-md hover:bg-primary-container hover:text-white transition-all">Subscribe Now</button>
</a>
</div>
</div>
<!-- Features Comparison Table -->
<section class="mb-20">
<h2 class="font-headline-lg text-headline-lg text-on-surface text-center mb-12">Detailed Feature Comparison</h2>
<div class="overflow-x-auto rounded-xl border border-outline-variant bg-surface-container-lowest">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-surface-container-low border-b border-outline-variant">
<th class="p-stack-md font-label-md text-label-md text-on-surface">Features</th>
<th class="p-stack-md font-label-md text-label-md text-on-surface">Free</th>
<th class="p-stack-md font-label-md text-label-md text-on-surface">Pro</th>
<th class="p-stack-md font-label-md text-label-md text-on-surface">Enterprise</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant">
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">Daily Conversions</td>
<td class="p-stack-md font-body-sm text-body-sm">5 per day</td>
<td class="p-stack-md font-body-sm text-body-sm font-bold text-primary">Unlimited</td>
<td class="p-stack-md font-body-sm text-body-sm font-bold text-primary">Unlimited</td>
</tr>
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">Max File Size</td>
<td class="p-stack-md font-body-sm text-body-sm">10 MB</td>
<td class="p-stack-md font-body-sm text-body-sm">2 GB</td>
<td class="p-stack-md font-body-sm text-body-sm">10 GB +</td>
</tr>
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">OCR Support</td>
<td class="p-stack-md font-body-sm text-body-sm opacity-50"><span class="material-symbols-outlined" data-icon="remove">remove</span></td>
<td class="p-stack-md font-body-sm text-body-sm"><span class="material-symbols-outlined text-primary" data-icon="done">done</span></td>
<td class="p-stack-md font-body-sm text-body-sm"><span class="material-symbols-outlined text-primary" data-icon="done">done</span></td>
</tr>
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">Cloud Storage</td>
<td class="p-stack-md font-body-sm text-body-sm">None</td>
<td class="p-stack-md font-body-sm text-body-sm">100 GB</td>
<td class="p-stack-md font-body-sm text-body-sm">Unlimited</td>
</tr>
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">Batch Processing</td>
<td class="p-stack-md font-body-sm text-body-sm opacity-50">Up to 3 files</td>
<td class="p-stack-md font-body-sm text-body-sm">Unlimited</td>
<td class="p-stack-md font-body-sm text-body-sm">Unlimited</td>
</tr>
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">Customer Support</td>
<td class="p-stack-md font-body-sm text-body-sm">Help Center</td>
<td class="p-stack-md font-body-sm text-body-sm">Priority Email</td>
<td class="p-stack-md font-body-sm text-body-sm">24/7 Dedicated</td>
</tr>
<tr>
<td class="p-stack-md font-body-sm text-body-sm font-semibold">Custom API Access</td>
<td class="p-stack-md font-body-sm text-body-sm opacity-50"><span class="material-symbols-outlined" data-icon="remove">remove</span></td>
<td class="p-stack-md font-body-sm text-body-sm opacity-50"><span class="material-symbols-outlined" data-icon="remove">remove</span></td>
<td class="p-stack-md font-body-sm text-body-sm"><span class="material-symbols-outlined text-primary" data-icon="done">done</span></td>
</tr>
</tbody>
</table>
</div>
</section>
<!-- Trust Section -->
<section class="bg-surface-container-low rounded-xl p-stack-lg border border-outline-variant flex flex-col md:flex-row items-center gap-gutter mb-20">
<div class="flex-1">
<h3 class="font-headline-md text-headline-md text-on-surface mb-stack-sm">Why 10M+ users trust us</h3>
<p class="font-body-md text-body-md text-on-surface-variant mb-stack-md">We prioritize your data security and conversion accuracy above all else. Your files are automatically deleted after 2 hours.</p>
<div class="flex flex-wrap gap-stack-md">
<div class="flex items-center gap-stack-sm px-stack-md py-2 bg-surface-container-lowest rounded-full border border-outline-variant shadow-sm">
<span class="material-symbols-outlined text-[18px]" data-icon="security" style="font-variation-settings: 'FILL' 1;">security</span>
<span class="text-label-sm font-label-sm">ISO 27001 Certified</span>
</div>
<div class="flex items-center gap-stack-sm px-stack-md py-2 bg-surface-container-lowest rounded-full border border-outline-variant shadow-sm">
<span class="material-symbols-outlined text-[18px]" data-icon="encrypted" style="font-variation-settings: 'FILL' 1;">encrypted</span>
<span class="text-label-sm font-label-sm">SSL Encrypted</span>
</div>
</div>
</div>
<div class="w-full md:w-64 h-48 rounded-lg overflow-hidden shrink-0">
<img class="w-full h-full object-cover" data-alt="A clean, minimalist high-tech visualization of secure data flowing through encrypted tunnels. Glowing lines of light in shades of Lapis Blue and slate gray weave together, forming a protective shield icon in the center. The aesthetic is corporate and modern with a pure white background and soft ambient shadows." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDacvAb4RnVQI6taGwJXzt1vLsuKiA15LV65xPnr-LbE7-e10bi09Qj7ebdrZA1sIYWvUe51Zlhx4AgSyyoE1R2dlYc5k6vS3GkgbLgY3b33cKzBXnnuzbnI8x9XbNBmLJ0gN3YqBykaHbyh2S6zhjiCSb12hbsJoeuroqpBILCogkeYgwmrGlWSbUXfC7QY_0fXgutFrk_L2ADoxhuPfwozPI33beWdjJE-Rx1xT-bUI8Gqje5LBjL"/>
</div>
</section>
</main>


{{--<h1>Pricing</h1>

<p>Choose a plan that works for you. Unlock full features in our native apps.</p>

<hr>

<h2>Single Purchase</h2>
<p>One-time payment. Lifetime access.</p>

<ul>
    <li>Unlimited conversions</li>
    <li>All file formats supported</li>
    <li>Offline conversion</li>
    <li>Batch processing</li>
    <li>Free updates</li>
    <li>One device only</li>
</ul>

<strong>Price: $9.99</strong>

<a href="{{ route('checkout', 'single') }}">
    <button type="button">Buy Now</button>
</a>

<hr>

<h2>Subscription</h2>
<p>Monthly subscription. Cancel anytime.</p>

<ul>
    <li>Everything in Single Purchase</li>
    <li>Multi-device support (up to 3 devices)</li>
    <li>Priority support</li>
    <li>Early access to new features</li>
    <li>Cloud sync (coming soon)</li>
</ul>

<strong>Price: $4.99/month</strong>

<a href="{{ route('checkout', 'subscription') }}">
    <button type="button">Subscribe Now</button>
</a>

<hr>

<h2>Free Tier</h2>
<p>No account needed. Limited features.</p>

<ul>
    <li>5 conversions per day (web only)</li>
    <li>Basic file formats</li>
    <li>Max file size: 100MB</li>
</ul>

<a href="{{ route('convert.index') }}">
    <button type="button">Start Free</button>
</a> --}}
@endsection
