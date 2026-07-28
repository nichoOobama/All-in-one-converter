@extends('auth.layouts')

@section('title', 'Login')

@section('content')
<!-- TopNavBar (Shell Logic: Suppressed for Transactional Page, but defined for branding) -->
<header class="bg-surface docked full-width top-0 border-b border-outline-variant">
<div class="flex justify-between items-center w-full px-margin-desktop max-w-container-max mx-auto h-16">
<div class="text-headline-md font-headline-md font-extrabold text-primary">
                All In One Converter
            </div>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="{{route('home')}}">
                Back to Home
            </a>
</div>
</header>
<!-- Main Content: Login Form Canvas -->
<main class="flex-grow flex items-center justify-center px-margin-mobile py-stack-lg">
<div class="w-full max-w-[440px] animate-in fade-in slide-in-from-bottom-4 duration-700">
<!-- Login Card -->
<div class="bg-white p-stack-lg rounded-xl login-card">
<div class="text-center mb-stack-lg">
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-2">Welcome Back</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Manage your conversions with ease.</p>
</div>
<form action="{{ route('login') }}" method="POST" class="space-y-gutter">
    @csrf
<!-- Email Input -->
<div>
<label class="block font-label-md text-label-md text-on-surface mb-stack-sm" for="email">Email Address</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
<input class="w-full pl-10 pr-4 py-3 bg-[#F8FAFC] border border-outline-variant rounded-lg font-body-md text-body-md input-focus-ring transition-all" id="email"  value="{{ old('email') }}" name="email" placeholder="name@company.com" required type="email"/>
</div>
</div>
<!-- Password Input -->
<div>
<div class="flex justify-between items-center mb-stack-sm">
<label class="block font-label-md text-label-md text-on-surface" for="password">Password</label>
<a class="font-label-sm text-label-sm text-primary hover:underline" href="#">Forgot Password?</a>
</div>
<div class="relative">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
<input class="w-full pl-10 pr-10 py-3 bg-[#F8FAFC] border border-outline-variant rounded-lg font-body-md text-body-md input-focus-ring transition-all" name="password" id="password" placeholder="••••••••" required type="password"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors" type="button">
<span class="material-symbols-outlined text-[20px]">visibility</span>
</button>
</div>
</div>
<!-- Sign In Button -->
<button class="w-full py-3 px-6 bg-primary text-on-primary font-label-md text-label-md rounded-lg hover:opacity-90 active:scale-[0.98] transition-all shadow-sm" type="submit">
                        Login
                    </button>
</form>
<!-- Divider -->
<div class="relative my-stack-lg">
<div class="absolute inset-0 flex items-center">
<div class="w-full border-t border-outline-variant"></div>
</div>
<div class="relative flex justify-center text-label-sm">
<span class="bg-white px-4 text-on-surface-variant font-label-sm">Or continue with</span>
</div>
</div>
<!-- Social Login -->
<button class="w-full flex items-center justify-center gap-3 py-3 px-6 border border-outline-variant rounded-lg font-label-md text-label-md text-on-surface hover:bg-surface-container-low transition-colors duration-200" type="button">
<svg class="w-5 h-5" viewbox="0 0 24 24">
<path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
<path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
<path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
<path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
</svg>
                    Google
                </button>
<!-- Footer Links -->
<div class="mt-stack-lg text-center">
<p class="font-body-sm text-body-sm text-on-surface-variant">
                        Don't have an account? 
                        <a class="text-primary font-bold hover:underline transition-all" href="{{ route('register') }}">Register Here</a>
</p>
</div>
</div>
<!-- Trust Badges / Info -->
<div class="mt-stack-lg grid grid-cols-3 gap-gutter text-center opacity-60">
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[24px] mb-1">security</span>
<span class="font-label-sm text-label-sm">Secure</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[24px] mb-1">bolt</span>
<span class="font-label-sm text-label-sm">Fast</span>
</div>
<div class="flex flex-col items-center">
<span class="material-symbols-outlined text-[24px] mb-1">verified_user</span>
<span class="font-label-sm text-label-sm">Private</span>
</div>
</div>
</div>
</main>
<!-- Footer Component -->
<footer class="bg-surface-container-low border-t border-outline-variant">
<div class="flex flex-col md:flex-row justify-between items-center w-full py-stack-lg px-margin-desktop max-w-container-max mx-auto">
<div class="text-label-md font-label-md font-bold text-on-surface mb-stack-md md:mb-0">
                All In One Converter
            </div>
<div class="flex gap-gutter mb-stack-md md:mb-0">
<a class="font-label-sm text-label-sm text-on-surface-variant hover:on-surface hover:underline transition-all" href="#">Terms</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:on-surface hover:underline transition-all" href="#">Privacy</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:on-surface hover:underline transition-all" href="#">Support</a>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant">
                © 2024 All In One Converter. All rights reserved.
            </p>
</div>
</footer>
@endsection
