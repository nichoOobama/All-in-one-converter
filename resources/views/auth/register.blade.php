@extends('auth.layouts')

@section('title', 'Register')

@section('content')
<!-- Header / Brand Section -->
<header class="w-full flex justify-between items-center px-margin-desktop max-w-container-max mx-auto h-16">
<div class="text-headline-md font-headline-md font-extrabold text-primary">All In One Converter</div>
<div class="flex items-center gap-stack-md">
<a href="{{route('login')}}" class="bg-primary text-on-primary px-stack-lg py-2 rounded-lg font-label-md text-label-md hover:opacity-90 transition-opacity">
Login
</a>
<a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors duration-200" href="{{route('home')}}">
                Back to Home
            </a>
</div>
</header>
<!-- Main Registration Section -->
<main class="flex-grow flex items-center justify-center px-margin-mobile md:px-0 py-stack-lg relative overflow-hidden">
<!-- Subtle Decorative Background (Abstract Minimalist Art) -->
<div class="absolute inset-0 z-0 pointer-events-none opacity-40">
<div class="absolute top-[-10%] right-[-10%] w-96 h-96 bg-primary-fixed rounded-full blur-[100px]"></div>
<div class="absolute bottom-[-10%] left-[-10%] w-96 h-96 bg-surface-container-high rounded-full blur-[100px]"></div>
</div>
<!-- Registration Card -->
<div class="z-10 w-full max-w-[440px] bg-white p-10 rounded-xl border border-outline-variant ambient-shadow">
<div class="text-center mb-stack-lg">
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-2">Create Account</h1>
<p class="font-body-md text-body-md text-on-surface-variant">Join thousands of users converting files daily with precision and speed.</p>
</div>
<!-- Social Register Option -->
<button class="w-full flex items-center justify-center gap-stack-sm py-3 px-gutter border border-outline-variant rounded-lg font-label-md text-label-md text-on-surface hover:bg-surface-container-low transition-all duration-200 mb-6">
<img alt="Google Logo" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB8U3TCC2y5Wn9pjnj9qc29TBsA5RVwEALQ12kuDQVPIOv7m5dKdw-jXCzzeWpoZGYymal9BYLwS5WhrJ66Vz6ZgaPhtg7equKZ05VXZqwSYEcah52nHZZCC_pznjLgSj-7kkhkuElOTJo0Y3bIxIjkVr825PvwvSCxpkNAdZS-Qmce0BZgzcWZl0-friUr_yYz-gIRv0hPyR5P8T7hslWUKmqvrNFTFHknp6B1Vs0CLJFBm8OWvqAjt8C3pZ4RDsa2F_17zkEv5u4"/>
                Sign up with Google
            </button>
<div class="relative flex items-center mb-6">
<div class="flex-grow border-t border-outline-variant"></div>
<span class="flex-shrink mx-4 font-label-sm text-label-sm text-outline uppercase tracking-wider">Or continue with email</span>
<div class="flex-grow border-t border-outline-variant"></div>
</div>
<!-- Form -->
<form action="{{ route('register') }}" method="POST" class="space-y-gutter">
    @csrf
<div class="space-y-2">
<label class="font-label-md text-label-md text-on-surface" for="full_name">Name</label>
<input class="w-full px-4 py-3 bg-[#F8FAFC] border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md" id="full_name" placeholder="Enter your full name" type="text" name="name" id="name" value="{{ old('name') }}" required/>
</div>
<div class="space-y-2">
<label class="font-label-md text-label-md text-on-surface" for="email">Email Address</label>
<input class="w-full px-4 py-3 bg-[#F8FAFC] border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md" id="email" placeholder="name@company.com" type="email" name="email" id="email" value="{{ old('email') }}" required/>
</div>
<div class="space-y-2">
<label class="font-label-md text-label-md text-on-surface" for="password">Password</label>
<div class="relative">
<input class="w-full px-4 py-3 bg-[#F8FAFC] border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md" id="password" placeholder="••••••••" type="password" name="password" id="password" required/>
<button class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary" type="button">
<span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
</button>
</div>
<div class="space-y-2">
<label class="font-label-md text-label-md text-on-surface" for="password">Confirm Password</label>
<div class="relative">
<input class="w-full px-4 py-3 bg-[#F8FAFC] border border-outline-variant rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all font-body-md text-body-md" id="password" placeholder="••••••••" type="password" name="password_confirmation" id="password_confirmation" required/>
<button class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary" type="button">
<span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
</button>
</div>
<p class="font-label-sm text-label-sm text-outline mt-1">Must be at least 8 characters long.</p>
</div>
<button class="w-full py-4 bg-primary text-on-primary font-label-md text-label-md rounded-lg shadow-sm hover:opacity-90 active:scale-[0.98] transition-all duration-200 mt-2" type="submit">
                    Register
                </button>
</form>
<div class="mt-stack-lg text-center">
<p class="font-body-sm text-body-sm text-on-surface-variant">
                    Already have an account? 
                    <a class="text-primary font-label-md hover:underline transition-all" href="{{ route('login') }}">Login</a>
</p>
</div>
</div>
</main>
<!-- Footer -->
<footer class="w-full bg-surface-container-low border-t border-outline-variant mt-auto">
<div class="flex flex-col md:flex-row justify-between items-center w-full py-stack-lg px-margin-desktop max-w-container-max mx-auto gap-4 md:gap-0">
<div class="font-label-md text-label-md font-bold text-on-surface">All In One Converter</div>
<div class="font-body-sm text-body-sm text-on-surface-variant">© 2024 All In One Converter. All rights reserved.</div>
<div class="flex gap-gutter">
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-on-surface hover:underline transition-all" href="#">Terms</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-on-surface hover:underline transition-all" href="#">Privacy</a>
<a class="font-label-sm text-label-sm text-on-surface-variant hover:text-on-surface hover:underline transition-all" href="#">Support</a>
</div>
</div>
</footer>
<script>
        // Micro-interaction for password toggle
        const toggleBtn = document.querySelector('button[type="button"]');
        const passwordInput = document.getElementById('password');
        const icon = toggleBtn.querySelector('.material-symbols-outlined');

        toggleBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                icon.textContent = 'visibility';
            }
        });

        // Atmospheric effect: Subtle mouse parallax on decorative blobs
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            const blobs = document.querySelectorAll('.absolute.inset-0.z-0 div');
            blobs.forEach((blob, index) => {
                const speed = (index + 1) * 20;
                blob.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });
    </script>
@endsection
