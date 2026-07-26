@extends('layouts.app')

@section('title', 'Download Apps')

@section('content')
<h1>Download Native Apps</h1>

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

<a href="/downloads/android/app.apk">
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
<p><strong>Pro features:</strong> Unlimited conversions, batch processing, priority support</p>
@endsection
