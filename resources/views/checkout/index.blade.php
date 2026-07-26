@extends('layouts.app')

@section('title', 'Checkout - ' . ucfirst($plan))

@section('content')
<h1>Checkout: {{ $plan === 'single' ? 'Single Purchase' : 'Subscription' }}</h1>

<p>Price: <strong>{{ $plan === 'single' ? '$9.99 (one-time)' : '$4.99/month' }}</strong></p>

<hr>

<h2>Payment Information</h2>
<p><em>This is a demo. No real payment will be processed.</em></p>

<form action="{{ route('checkout.process', $plan) }}" method="POST">
    @csrf

    <div>
        <label for="name">Full Name:</label><br>
        <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name ?? '') }}" required>
    </div>

    <div>
        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
    </div>

    <div>
        <label for="card_number">Card Number:</label><br>
        <input type="text" name="card_number" id="card_number" value="4242 4242 4242 4242" placeholder="Card Number" disabled>
        <small>(Demo - pre-filled)</small>
    </div>

    <div>
        <label for="card_expiry">Expiry:</label><br>
        <input type="text" name="card_expiry" id="card_expiry" value="12/28" placeholder="MM/YY" disabled>
    </div>

    <div>
        <label for="card_cvc">CVC:</label><br>
        <input type="text" name="card_cvc" id="card_cvc" value="123" placeholder="CVC" disabled>
    </div>

    <br>
    <button type="submit">Complete Purchase</button>
</form>

<p><a href="{{ route('pricing') }}">Back to Pricing</a></p>
@endsection
