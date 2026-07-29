@extends('layouts.landing')

@section('title', 'Download Apps')

@section('content')

<main class="max-w-container-max mx-auto px-margin-desktop py-stack-lg space-y-24">
<!-- Hero Section -->
<section class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center pt-8">
<div class="space-y-stack-md">
<div class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[14px] mr-2">verified</span> New Version 4.0 Now Available
                </div>
<h1 class="font-display text-display text-on-background tracking-tight">Convert without limits, <span class="text-primary">wherever</span> you are.</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-xl">
                    Experience the power of All In One Converter on your desktop and mobile. Fast, offline-ready, and seamlessly integrated into your workflow.
                </p>
<div class="flex flex-wrap gap-gutter pt-4">
<a class="bg-primary text-on-primary px-8 py-4 rounded-lg font-label-md text-label-md flex items-center shadow-lg hover:opacity-90 transition-all" href="/downloads/windows/setup.exe">
<span class="material-symbols-outlined mr-2">desktop_windows</span> Download for Windows
                    </a>
<a class="border border-outline text-on-surface px-8 py-4 rounded-lg font-label-md text-label-md flex items-center hover:bg-surface-variant transition-all" href="/downloads/android/app.apk">
<span class="material-symbols-outlined mr-2">smartphone</span> Mobile Apps
                    </a>
</div>
</div>
<div class="relative">
<div class="absolute -top-10 -right-10 w-64 h-64 bg-primary-container/20 rounded-full blur-3xl -z-10"></div>
<div class="ambient-shadow rounded-xl overflow-hidden border border-outline-variant bg-white p-4">
<img class="w-full h-auto rounded-lg" data-alt="A ultra-high-definition minimalist product mockup of a sleek professional software interface running on a premium gray laptop and a high-end smartphone side by side. The laptop displays a clean dashboard with file conversion queues and progress bars in Primary Blue. The smartphone shows a simplified mobile version of the same app. The lighting is soft and studio-quality with a light mode aesthetic." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJ7-Tpee4UPqaeATBfj4DwPSw75XlL5WK6_LQ0DqbMaio-f9M13ujHfFd6GJNPjNu2_G1CsZwEDI2BC6gyipQjV6oapgLAvoHosxYeTEX2bL3IfUbsszIGMPxK9BalueR1eiBhXnFlDzOpR6SgHn4Yh83oE30xF0NDxuGWZl0oCdbxaRSBS2V-ceT41p1Wu__Y-iSPxlbVP1QkqJkpHmCRy7l99JI7rkRgvCCzvo9dOIbnaRqNKgEE"/>
</div>
</div>
</section>
<!-- Bento Grid Features -->
<section class="space-y-stack-lg">
<div class="text-center max-w-2xl mx-auto space-y-4">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Engineered for Performance</h2>
<p class="font-body-md text-body-md text-on-surface-variant">Our native applications are built to leverage your hardware's full potential for faster results.</p>
</div>
<div class="grid grid-cols-1 md:grid-cols-12 gap-gutter auto-rows-[240px]">
<!-- Card 1 -->
<div class="md:col-span-8 glass-card rounded-xl p-stack-lg flex flex-col justify-between group hover:border-primary transition-all cursor-default">
<div class="space-y-4">
<span class="material-symbols-outlined text-primary text-4xl" style="font-variation-settings: 'FILL' 1;">cloud_off</span>
<h3 class="font-headline-md text-headline-md">Offline First</h3>
<p class="font-body-md text-body-md text-on-surface-variant max-w-md">No internet? No problem. Convert sensitive documents and heavy media files directly on your machine without uploading a single byte.</p>
</div>
</div>
<!-- Card 2 -->
<div class="md:col-span-4 bg-primary-container rounded-xl p-stack-lg flex flex-col justify-end relative overflow-hidden">
<div class="absolute top-4 right-4 opacity-20">
<span class="material-symbols-outlined text-8xl text-on-primary-container">speed</span>
</div>
<div class="z-10">
<h3 class="font-headline-md text-headline-md text-on-primary-container">Bulk Engine</h3>
<p class="font-body-sm text-body-sm text-on-primary-container/80 mt-2">Process thousands of files simultaneously with our multi-threaded desktop architecture.</p>
</div>
</div>
<!-- Card 3 -->
<div class="md:col-span-4 glass-card rounded-xl p-stack-lg flex flex-col items-center justify-center text-center space-y-4">
<div class="w-16 h-16 rounded-full bg-surface-variant flex items-center justify-center">
<span class="material-symbols-outlined text-primary text-2xl">sync</span>
</div>
<div>
<h3 class="font-label-md text-label-md uppercase tracking-widest text-secondary">Cloud Sync</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-2">Start a task on mobile, finish it on your Mac with real-time license syncing.</p>
</div>
</div>
<!-- Card 4 -->
<div class="md:col-span-8 glass-card rounded-xl overflow-hidden flex flex-col md:flex-row group transition-all">
<div class="p-stack-lg flex-1 space-y-4">
<h3 class="font-headline-md text-headline-md">Deep OS Integration</h3>
<p class="font-body-md text-body-md text-on-surface-variant">Right-click any file in Windows Explorer or macOS Finder to convert instantly using the context menu extension.</p>
<ul class="space-y-2 pt-2">
<li class="flex items-center text-body-sm"><span class="material-symbols-outlined text-primary text-[18px] mr-2">check_circle</span> Context Menu Support</li>
<li class="flex items-center text-body-sm"><span class="material-symbols-outlined text-primary text-[18px] mr-2">check_circle</span> Drag &amp; Drop Interface</li>
<li class="flex items-center text-body-sm"><span class="material-symbols-outlined text-primary text-[18px] mr-2">check_circle</span> Keyboard Shortcuts</li>
</ul>
</div>
<div class="flex-1 bg-surface-container h-full">
<img class="w-full h-full object-cover" data-alt="A close-up high-quality 3D render of a modern operating system desktop environment. A right-click context menu is shown over a set of icons, highlighting a sleek 'All In One Converter' menu item with a crisp blue icon. The background is a clean, blurred aesthetic wallpaper typical of modern professional computing environments." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzFbxPBjqhdrYWbqG7UyB08qoOlMZeNrwZK4ej7jJoYlS04i6cejVoJdCfZNSHauBUL8NkOQMfBAsvWbi27kGcLmI2VUBZEXxYiqsrnALJjQR1TQxRGSNZBcQ_Qw1zqjk3WXooRxObd-w0M3v_moAgPexhAFvZq5xpUETBK3j5kzrBBtDwJb1G3K2JtQy68ZFqFkQ_-0pwaj9pXT31zDd18ClhwJPVyESiUXHclRTCGHCSUNjlQw6C"/>
</div>
</div>
</div>
</section>
<!-- Platform Specific Downloads -->
<section class="space-y-stack-lg scroll-mt-24" id="desktop">
<div class="flex items-center justify-between">
<h2 class="font-headline-lg text-headline-lg text-on-surface">Desktop Applications</h2>
<div class="h-[1px] flex-grow mx-8 bg-outline-variant"></div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 gap-gutter">
<!-- Windows Card -->
<div class="ambient-shadow border border-outline-variant rounded-xl p-8 bg-white flex flex-col md:flex-row gap-8 items-center hover:shadow-md transition-shadow">
<div class="w-24 h-24 flex-shrink-0 bg-surface-container flex items-center justify-center rounded-2xl">
<img alt="Windows Logo" class="w-12 h-12" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAdYybRhq8yENA-JH4mNFXMpEZGXNWwyTvvfvg5C-iXjOshx1_dgWtHNGpgxdAeRQCCw0ZxiP1Q56jSRnZHsrBl3D41C_0-_OTv68YyA9w0840lbvjg8bZNox8wkY4wLHs19IAgU4_Yyx-BTGic4fZNc23zDYnTbgP8Piz9fE16F1xSVZeriqz58rCst8B34mrLPEdN19_wG2ggscIsTSBiJ5PR0yli5vdnUYGywrtpIosoMbp3HF9N"/>
</div>
<div class="flex-grow space-y-2 text-center md:text-left">
<h3 class="font-headline-md text-headline-md">Windows</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">Compatible with Windows 10 &amp; 11 (64-bit). MSI Installer available for enterprise deployment.</p>
<div class="pt-4 flex flex-col sm:flex-row">
<a href="/downloads/windows/setup.exe" class="bg-primary text-on-primary px-6 py-2 rounded font-label-md text-label-md flex items-center justify-center">
<span class="material-symbols-outlined mr-2">download</span> Download .exe
                            </a>
</div>
</div>
</div>
</div>
</section>
<!-- Mobile Apps Section -->
<section class="bg-surface-container rounded-3xl p-stack-lg md:p-16 scroll-mt-24" id="mobile">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
<div class="space-y-stack-md">
<h2 class="font-headline-lg text-headline-lg text-on-surface">On the Go Productivity</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant">
                        Our mobile app isn't just a companion—it's a fully functional converter that fits in your pocket. Scan documents with your camera and convert them instantly to searchable PDFs.
                    </p>
<div class="grid grid-cols-2 gap-gutter pt-4">
<div class="flex items-start gap-4">
<span class="material-symbols-outlined text-primary">camera_alt</span>
<div>
<h4 class="font-label-md text-label-md">OCR Scanning</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Turn photos into editable text.</p>
</div>
</div>
<div class="flex items-start gap-4">
<span class="material-symbols-outlined text-primary">share</span>
<div>
<h4 class="font-label-md text-label-md">Direct Share</h4>
<p class="font-body-sm text-body-sm text-on-surface-variant">Send to any app instantly.</p>
</div>
</div>
</div>
<div class="flex flex-wrap gap-stack-md pt-8">
<a class="h-14" href="#">
<img class="h-full" data-alt="A professional graphic of the App Store 'Download on the App Store' badge icon, set against a clean white background, maintaining official brand guidelines." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDExshlk0kVKpwKmGGQILB6iQh3b1BEZcuNconMewxLIovLLPU6iiYz8MXN6_7q6RcnSUVlUwe2q65LYuXnT1mGB-aNmdMfQUHkQ35vBCWNLjXqOxRy6RPk_z6PwwSFrrljmnk71nFxiJ32rSiXf0gQqJulxeN8r2KY01xftWAGaEvzwrvOZnhMGqKNikjx3w6N2CcwyfZJav0RcsGxZj4HOVPUB6F-VlFhVnbVodFF1ZwiTiC_BxQc"/>
</a>
<a class="h-14" href="#">
<img class="h-full" data-alt="A professional graphic of the Google Play Store 'Get it on Google Play' badge icon, set against a clean white background, maintaining official brand guidelines." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjrfFw_yI_p1YCUp803SAtVReoleYWYcmqzdzjdd2XMchjIFaUaQmNOkgqVSma5xzhzJUEJs-VRRmgtccvbGPKIn9M0_lrSelL_i66I0zSZ6n53UUu8gHzaozeRCCu8mCaZvijPdCpld3nitnxpKgMMJq64taEM3UR_sbNP_I3a3unzwCmzJ31H04nu0ijxrVvH4pSj3wsKVJ642bCGlwPYSzmteLeMtvkh4gg-75YNKRs69uGUA1u"/>
</a>
</div>
</div>
<div class="flex justify-center">
<img class="max-w-md w-full drop-shadow-2xl" data-alt="A stunning 3D isometric mockup of two high-end smartphones floating in space. One phone shows the 'All In One Converter' app interface with a large 'Select Files' button and several conversion icon categories (PDF, Image, Video). The second phone shows a successful conversion screen with a checkmark. The overall aesthetic is clean, professional, and uses Primary Blue accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxQtSUOoS_meaIpHZjgLpkxDrdNDdJ23ZVZJYV0pZw2wnFRSrkfxpiVQAnZBk2Ug1NZKUruIzfIiVdYfWuByqJlN2A11Qatlc8H3MhMmh_RLsJsoQX8-EvlnpQilG2zRPMCnJNdoIIJubB7h2zukcd33DSbkhiz5yJLOH8lARERhjjT7elm80aqV37oEPh6_NKMP1-RBdtrmWPv7jXUZJePJ-GMzaNLv9vSqjqVVEN7RgxvyP-eeQw"/>
</div>
</div>
</section>
</main>
{{--<h1>Download Native Apps</h1>

<p>Download our cross-platform application for offline file conversion. Available for Windows and Android.</p>

<hr>

<h2>Windows Desktop App</h2>
<p>A powerful desktop application for Windows that allows you to convert files offline without internet connection.</p>

<ul>
    <li>Convert images, videos, audio, and documents</li>
    <li>Batch conversion support</li>
    <li>Fast processing with local engine</li>
    <li>No file upload needed - everything stays on your computer</li>
</ul>

<a href="/downloads/windows/setup.exe">
    <button type="button">Download for Windows</button>
</a>

<p><strong>Requirements:</strong> Windows 10 or later, 4GB RAM, 500MB free disk space</p>

<hr>

<h2>Android App</h2>
<p>Convert files directly from your Android phone. Perfect for quick conversions on the go.</p>

<ul>
    <li>Support all major file formats</li>
    <li>Share converted files directly</li>
    <li>Offline conversion support</li>
    <li>Lightweight and fast</li>
</ul>

<a href="">
    <button type="button">Download APK for Android</button>
</a>

<p><strong>Requirements:</strong> Android 8.0 or later, 100MB free storage</p>

<hr>

<h2>License Activation</h2>
<p>To unlock all features in the native apps, you need a license key.</p>
<ol>
    <li>Create an account or login</li>
    <li>Purchase a license from <a href="{{ route('pricing') }}">Pricing page</a></li>
    <li>Copy your license key from <a href="{{ route('licenses') }}">My Licenses</a></li>
    <li>Enter the key in the native app settings</li>
</ol>

<p><strong>Free features:</strong> Limited conversions per day</p>
<p><strong>Pro features:</strong> Unlimited conversions, batch processing, priority support</p> --}}
@endsection
