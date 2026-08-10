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
                    "secondary-fixed": "#d3e4fe",
                    "surface-container-low": "#f0f3ff",
                    "inverse-surface": "#263143",
                    "surface-dim": "#cfdaf2",
                    "on-surface-variant": "#434653",
                    "surface-container-highest": "#d8e3fb",
                    "on-secondary-fixed-variant": "#38485d",
                    "on-primary-fixed": "#001945",
                    "primary-container": "#0f52ba",
                    "outline-variant": "#c3c6d5",
                    "surface-container-high": "#dee8ff",
                    "on-tertiary-container": "#caced2",
                    "primary": "#003c90",
                    "on-primary-fixed-variant": "#00419c",
                    "surface-tint": "#1d59c1",
                    "on-secondary-container": "#54647a",
                    "error": "#ba1a1a",
                    "surface": "#f9f9ff",
                    "on-tertiary-fixed": "#171c1f",
                    "on-primary-container": "#bcceff",
                    "on-secondary-fixed": "#0b1c30",
                    "inverse-on-surface": "#ecf1ff",
                    "on-error-container": "#93000a",
                    "primary-fixed-dim": "#b0c6ff",
                    "surface-container-lowest": "#ffffff",
                    "surface-container": "#e7eeff",
                    "primary-fixed": "#d9e2ff",
                    "inverse-primary": "#b0c6ff",
                    "on-surface": "#111c2d",
                    "secondary-fixed-dim": "#b7c8e1",
                    "on-tertiary": "#ffffff",
                    "secondary": "#505f76",
                    "outline": "#737784",
                    "tertiary-fixed": "#dfe3e7",
                    "on-primary": "#ffffff",
                    "on-secondary": "#ffffff",
                    "surface-bright": "#f9f9ff",
                    "on-background": "#111c2d",
                    "on-tertiary-fixed-variant": "#43474b",
                    "tertiary-container": "#53585c",
                    "tertiary-fixed-dim": "#c3c7cb",
                    "background": "#f9f9ff",
                    "secondary-container": "#d0e1fb",
                    "error-container": "#ffdad6",
                    "surface-variant": "#d8e3fb",
                    "tertiary": "#3c4144",
                    "on-error": "#ffffff"
                },
                "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
                },
                "spacing": {
                    "margin-mobile": "16px",
                    "stack-md": "16px",
                    "unit": "8px",
                    "gutter": "24px",
                    "stack-lg": "32px",
                    "container-max": "1200px",
                    "margin-desktop": "40px",
                    "stack-sm": "8px"
                },
                "fontFamily": {
                    "body-lg": ["Inter"],
                    "headline-lg": ["Inter"],
                    "display": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-md": ["Inter"],
                    "headline-lg-mobile": ["Inter"],
                    "label-sm": ["Inter"],
                    "label-md": ["Inter"],
                    "body-sm": ["Inter"]
                },
                "fontSize": {
                    "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                    "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                    "display": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                    "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                    "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                    "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                    "label-sm": ["12px", { "lineHeight": "14px", "fontWeight": "500" }],
                    "label-md": ["14px", { "lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600" }],
                    "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }]
                }
            }
        }
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
        .progress-bar-animated {
            background-image: linear-gradient(
                45deg,
                rgba(255, 255, 255, 0.15) 25%,
                transparent 25%,
                transparent 50%,
                rgba(255, 255, 255, 0.15) 50%,
                rgba(255, 255, 255, 0.15) 75%,
                transparent 75%,
                transparent
            );
            background-size: 1rem 1rem;
            animation: progress-stripes 1s linear infinite;
        }

        @keyframes progress-stripes {
            from { background-position: 1rem 0; }
            to { background-position: 0 0; }
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
    @stack('script')
</body></html>