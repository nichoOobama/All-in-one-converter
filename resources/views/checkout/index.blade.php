@extends('layouts.app')

@section('title', 'Checkout - ' . ucfirst($plan))

@section('content')

<main class="flex-grow flex items-center justify-center py-stack-lg px-margin-mobile md:px-margin-desktop">
<div class="max-w-xl w-full bg-surface-container-lowest border border-outline-variant rounded-lg p-gutter shadow-[0_4px_12px_rgba(0,0,0,0.03)]">
<header class="mb-stack-md text-center">
<h1 class="font-headline-lg text-headline-lg text-primary mb-stack-sm">Checkout: {{ $plan === 'single' ? 'Single Purchase' : 'Subscription' }}</h1>
<p class="font-body-lg text-body-lg text-on-surface-variant">Price: {{ $plan === 'single' ? '$9.99 (one-time)' : '$4.99/month' }}</p>
</header>
<div class="bg-surface-container-high border-l-4 border-primary p-unit mb-stack-md rounded-r-DEFAULT flex items-center gap-unit">
<span aria-hidden="true" class="material-symbols-outlined text-primary" data-icon="info">info</span>
<p class="font-body-sm text-body-sm text-on-surface-variant">This is a demo. No real payment will be processed.</p>
</div>
<form class="space-y-stack-md" action="{{route('checkout.process', $plan )}}" method="post">
    @csrf
<h2 class="font-headline-md text-headline-md text-on-surface border-b border-outline-variant pb-unit mb-stack-sm">Payment Information</h2>
<div class="space-y-unit">
<label class="block font-label-md text-label-md text-on-surface" for="fullName">Full Name</label>
<input class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg px-3 py-2 font-body-md focus:border-primary focus:ring-2 focus:ring-primary-container outline-none transition-colors duration-200" name="name" id="name" value="{{ old('name', auth()->user()->name ?? '') }}" required type="text"/>
</div>
<div class="space-y-unit">
<label class="block font-label-md text-label-md text-on-surface" for="email">Email Address</label>
<input class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg px-3 py-2 font-body-md focus:border-primary focus:ring-2 focus:ring-primary-container outline-none transition-colors duration-200" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" required type="email"/>
</div>
<div class="space-y-unit">
<label class="block font-label-md text-label-md text-on-surface" for="cardNumber">Card Number</label>
<div class="relative">
<span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none material-symbols-outlined text-outline" data-icon="credit_card">credit_card</span>
<input class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg pl-10 pr-3 py-2 font-body-md focus:border-primary focus:ring-2 focus:ring-primary-container outline-none transition-colors duration-200"  name="card_number" id="card_number" value="4242 4242 4242 4242" placeholder="Card Number" disabled type="text"/>
</div>
</div>
<div class="grid grid-cols-2 gap-gutter">
<div class="space-y-unit">
<label class="block font-label-md text-label-md text-on-surface" for="expiry">Expiry Date (MM/YY)</label>
<input class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg px-3 py-2 font-body-md focus:border-primary focus:ring-2 focus:ring-primary-container outline-none transition-colors duration-200" placeholder="MM/YY" type="text" name="card_expiry" id="card_expiry" value="12/28" disabled/>
</div>
<div class="space-y-unit">
<label class="block font-label-md text-label-md text-on-surface" for="cvc">CVC/CVV</label>
<input class="w-full bg-surface text-on-surface border border-outline-variant rounded-lg px-3 py-2 font-body-md focus:border-primary focus:ring-2 focus:ring-primary-container outline-none transition-colors duration-200" id="cvc" placeholder="123" type="text" name="card_cvc" disabled/>
</div>
</div>
<div class="pt-stack-sm">
<button class="w-full bg-primary text-on-primary font-label-md text-label-md py-3 px-6 rounded-lg hover:bg-primary-container hover:text-on-primary-container transition-colors duration-200 flex justify-center items-center gap-unit" type="submit">
<span class="material-symbols-outlined" data-icon="lock">lock</span>
                        Complete Purchase
                    </button>
                <p><a href="{{ route('pricing') }}">Back to Pricing</a></p>
</div>
</form>
</div>
</main>
@endsection
