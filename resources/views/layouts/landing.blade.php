<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>All In One Converter | Precision &amp; Efficiency</title>
<!-- Tailwind CSS with Plugins -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<!-- Material Symbols Outlined -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Google Fonts: Inter -->
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<!-- Design System Tokens -->
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "outline-variant": "#c3c6d5",
                    "inverse-on-surface": "#ecf1ff",
                    "surface-container-highest": "#d8e3fb",
                    "primary-fixed": "#d9e2ff",
                    "tertiary-fixed-dim": "#c3c7cb",
                    "on-primary": "#ffffff",
                    "on-secondary-fixed": "#0b1c30",
                    "surface-dim": "#cfdaf2",
                    "on-tertiary-fixed": "#171c1f",
                    "on-error-container": "#93000a",
                    "secondary": "#505f76",
                    "on-tertiary-fixed-variant": "#43474b",
                    "on-secondary": "#ffffff",
                    "primary-container": "#0f52ba",
                    "on-tertiary": "#ffffff",
                    "error-container": "#ffdad6",
                    "tertiary-fixed": "#dfe3e7",
                    "secondary-container": "#d0e1fb",
                    "on-tertiary-container": "#caced2",
                    "primary-fixed-dim": "#b0c6ff",
                    "surface-container": "#e7eeff",
                    "surface-tint": "#1d59c1",
                    "on-primary-fixed-variant": "#00419c",
                    "surface-variant": "#d8e3fb",
                    "on-error": "#ffffff",
                    "on-surface-variant": "#434653",
                    "tertiary": "#3c4144",
                    "on-surface": "#111c2d",
                    "error": "#ba1a1a",
                    "tertiary-container": "#53585c",
                    "on-secondary-container": "#54647a",
                    "inverse-primary": "#b0c6ff",
                    "secondary-fixed-dim": "#b7c8e1",
                    "on-primary-fixed": "#001945",
                    "background": "#f9f9ff",
                    "surface-container-low": "#f0f3ff",
                    "inverse-surface": "#263143",
                    "primary": "#003c90",
                    "on-background": "#111c2d",
                    "on-primary-container": "#bcceff",
                    "outline": "#737784",
                    "surface": "#f9f9ff",
                    "on-secondary-fixed-variant": "#38485d",
                    "surface-container-lowest": "#ffffff",
                    "surface-bright": "#f9f9ff",
                    "surface-container-high": "#dee8ff",
                    "secondary-fixed": "#d3e4fe"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "unit": "8px",
                    "margin-mobile": "16px",
                    "container-max": "1200px",
                    "stack-sm": "8px",
                    "gutter": "24px",
                    "margin-desktop": "40px",
                    "stack-md": "16px",
                    "stack-lg": "32px"
            },
            "fontFamily": {
                    "headline-lg-mobile": ["Inter"],
                    "headline-md": ["Inter"],
                    "body-md": ["Inter"],
                    "label-md": ["Inter"],
                    "headline-lg": ["Inter"],
                    "body-lg": ["Inter"],
                    "body-sm": ["Inter"],
                    "label-sm": ["Inter"],
                    "display": ["Inter"]
            },
            "fontSize": {
                    "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "label-md": ["14px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                    "body-sm": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                    "label-sm": ["12px", {"lineHeight": "14px", "fontWeight": "500"}],
                    "display": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .ambient-shadow {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.03);
        }
        .modal-shadow {
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.08);
        }
        .hero-mesh {
            background-image: radial-gradient(at 0% 0%, hsla(217, 100%, 96%, 1) 0, transparent 50%), 
                              radial-gradient(at 100% 0%, hsla(186, 100%, 94%, 1) 0, transparent 50%);
        }
        .drop-zone-border {
            border-image: linear-gradient(to right, #003c90, #c3c6d5) 1;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md overflow-x-hidden">
<!-- Top Navigation Bar -->
<header class="w-full h-16 bg-surface-container-lowest border-b border-outline-variant shadow-sm sticky top-0 z-50">
<div class="flex justify-between items-center px-margin-desktop max-w-container-max mx-auto h-full">
<div class="text-headline-md font-headline-md font-bold text-primary">All In One Converter</div>
<nav class="hidden md:flex items-center gap-gutter">
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors duration-200" href="{{route('home')}}">Home</a>
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors duration-200" href="{{route('download')}}">Download Apps</a>
<a class="font-label-md text-label-md text-secondary hover:text-primary transition-colors duration-200" href="{{route('pricing')}}">Pricing</a>
</nav>

<div class="flex items-center gap-stack-md">
<a href="{{route('register')}}" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:opacity-90 transition-opacity">Register</a>
</div>
</div>
</header>
@yield('content')
@include('footer.index')
@stack('script')
</body></html>
