<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>@yield('title') - All In One Converter</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-dim": "#cfdaf2",
                    "primary-fixed-dim": "#b0c6ff",
                    "surface-bright": "#f9f9ff",
                    "on-secondary-fixed": "#0b1c30",
                    "secondary": "#505f76",
                    "primary": "#003c90",
                    "inverse-surface": "#263143",
                    "on-tertiary-fixed-variant": "#43474b",
                    "tertiary": "#3c4144",
                    "secondary-fixed": "#d3e4fe",
                    "on-secondary": "#ffffff",
                    "on-error": "#ffffff",
                    "surface-container-highest": "#d8e3fb",
                    "error": "#ba1a1a",
                    "outline": "#737784",
                    "on-background": "#111c2d",
                    "secondary-fixed-dim": "#b7c8e1",
                    "error-container": "#ffdad6",
                    "tertiary-fixed-dim": "#c3c7cb",
                    "on-tertiary-container": "#caced2",
                    "primary-fixed": "#d9e2ff",
                    "tertiary-container": "#53585c",
                    "surface-variant": "#d8e3fb",
                    "on-tertiary": "#ffffff",
                    "on-secondary-fixed-variant": "#38485d",
                    "on-secondary-container": "#54647a",
                    "surface-container-low": "#f0f3ff",
                    "on-surface": "#111c2d",
                    "on-primary": "#ffffff",
                    "on-error-container": "#93000a",
                    "surface-container-lowest": "#ffffff",
                    "on-primary-fixed": "#001945",
                    "surface-container-high": "#dee8ff",
                    "background": "#f9f9ff",
                    "surface-tint": "#1d59c1",
                    "on-surface-variant": "#434653",
                    "inverse-on-surface": "#ecf1ff",
                    "surface": "#f9f9ff",
                    "on-primary-fixed-variant": "#00419c",
                    "on-tertiary-fixed": "#171c1f",
                    "primary-container": "#0f52ba",
                    "inverse-primary": "#b0c6ff",
                    "outline-variant": "#c3c6d5",
                    "tertiary-fixed": "#dfe3e7",
                    "surface-container": "#e7eeff",
                    "secondary-container": "#d0e1fb",
                    "on-primary-container": "#bcceff"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "stack-lg": "32px",
                    "unit": "8px",
                    "gutter": "24px",
                    "stack-sm": "8px",
                    "margin-desktop": "40px",
                    "container-max": "1200px",
                    "stack-md": "16px",
                    "margin-mobile": "16px"
            },
            "fontFamily": {
                    "label-sm": ["Inter"],
                    "label-md": ["Inter"],
                    "headline-lg": ["Inter"],
                    "body-sm": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-lg": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "display": ["Inter"],
                    "body-md": ["Inter"]
            },
            "fontSize": {
                    "label-sm": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                    "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "display": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .tonal-layer {
            background: #ffffff;
            border: 1px solid #E2E8F0;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.03);
        }
        .active-ring {
            box-shadow: 0 0 0 2px rgba(0, 60, 144, 0.2);
        }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">
    @if ($errors->any())
        <div style="border: 1px solid red; padding: 10px; margin-bottom 20px;">
            <strong>Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

 <!-- TopNavBar -->
<header class="bg-surface-container-lowest w-full h-16 border-b border-outline-variant shadow-sm z-50">
<div class="flex justify-between items-center px-margin-desktop max-w-container-max mx-auto h-full">
<div class="flex items-center gap-stack-md">
<span class="text-headline-md font-headline-md font-bold text-primary">All In One Converter</span>
</div>
<nav class="hidden md:flex items-center gap-gutter">
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors duration-200" href="{{route('convert.index')}}">Converter</a>
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors duration-200" href="{{route('licenses')}}">My License</a>
<a class="font-label-md text-label-md text-primary border-b-2 border-primary pb-1" href="{{route('dashboard')}}">Dashboard</a>
</nav>
<div class="flex items-center gap-stack-md">
<a href="{{route('pricing')}}" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md text-label-md hover:opacity-80 transition-opacity">
    Buy License
</a>
</div>
</div>
</header>
@yield('content')
@include('footer.index')
<script>
        // Simple interactivity for navigation items
        document.querySelectorAll('aside a').forEach(link => {
            link.addEventListener('click', (e) => {
                document.querySelectorAll('aside a').forEach(l => {
                    l.classList.remove('bg-primary-container', 'text-on-primary-container');
                    l.classList.add('text-secondary');
                });
                link.classList.remove('text-secondary');
                link.classList.add('bg-primary-container', 'text-on-primary-container');
            });
        });
    </script>
</body></html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'All-in-One Converter')</title>
</head>
<body>
    <nav>
        <a href="{{ route('convert.index') }}">Converter</a>
        <a href="{{ route('download') }}">Download Apps</a>
        <a href="{{ route('pricing') }}">Pricing</a>

        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('licenses') }}">My Licenses</a>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
            <span>{{ auth()->user()->name }}</span>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <hr>

    @if (session('success'))
        <div style="border: 1px solid green; padding: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="border: 1px solid red; padding: 10px; margin-bottom: 20px;">
            <strong>Errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</body>
</html> --}}
