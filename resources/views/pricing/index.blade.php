@extends('layouts.app')

@section('title', 'Pricing')

@section('content')
<h1>Pricing</h1>

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
</a>
@endsection
