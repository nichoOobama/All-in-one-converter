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

</nav>
<div class="flex items-center gap-stack-md">
<a href="{{route('register')}}" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label-md hover:opacity-90 transition-opacity">Register</a>
</div>
</div>
</header>
<!-- Hero Section -->
<section class="hero-mesh relative pt-24 pb-32">
<div class="max-w-container-max mx-auto px-margin-desktop text-center">
<h1 class="font-display text-display text-on-surface mb-stack-md animate-fade-in-up">
                All-In-One Conversion Suite
            </h1>
<p class="font-body-lg text-body-lg text-secondary max-w-2xl mx-auto mb-stack-lg">
                Fast, secure, and easy file conversion for any format. One tool for all your document, image, and media needs.
            </p>
<div class="max-w-xl mx-auto">
<a href="{{route('convert.index')}}" class="bg-primary text-on-primary px-8 py-3 rounded-lg font-label-md hover:opacity-90 transition-all">Convert Now</a>
</div>
<!-- Stats/Trust Badges -->
<div class="mt-12 flex justify-center gap-stack-lg items-center text-secondary opacity-60">
<div class="flex items-center gap-1">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">verified_user</span>
<span class="font-label-sm text-label-sm">Secure &amp; Private</span>
</div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">bolt</span>
<span class="font-label-sm text-label-sm">High-Speed Processing</span>
</div>
<div class="flex items-center gap-1">
<span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">cloud_done</span>
<span class="font-label-sm text-label-sm">Cloud Compatibility</span>
</div>
</div>
</div>
</section>
<!-- Tool Categories (Bento Grid) -->
<section class="max-w-container-max mx-auto px-margin-desktop py-stack-lg">
<div class="flex justify-between items-end mb-stack-lg">
<div>
<h2 class="font-headline-lg text-headline-lg text-on-surface">Universal Toolset</h2>
<p class="font-body-md text-body-md text-secondary mt-2">Specialized tools designed for precision conversion.</p>
</div>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
<!-- PDF Tools -->
<div class="bg-white p-8 rounded-xl border border-outline-variant ambient-shadow hover:shadow-lg transition-all duration-300">
<div class="text-red-500 mb-stack-md">
<span class="material-symbols-outlined" style="font-size: 32px;">picture_as_pdf</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">PDF Tools</h4>
<p class="font-body-sm text-body-sm text-secondary mb-4">Edit, merge, split, and convert PDF documents with ease.</p>
<ul class="space-y-2">
<li><a class="text-body-sm text-primary hover:underline" href="#">PDF to Word</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">Merge PDF</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">Compress PDF</a></li>
</ul>
</div>
<!-- Image Converters -->
<div class="bg-white p-8 rounded-xl border border-outline-variant ambient-shadow hover:shadow-lg transition-all duration-300">
<div class="text-primary mb-stack-md">
<span class="material-symbols-outlined" style="font-size: 32px;">image</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Image Tools</h4>
<p class="font-body-sm text-body-sm text-secondary mb-4">Batch process and convert images across all major formats.</p>
<ul class="space-y-2">
<li><a class="text-body-sm text-primary hover:underline" href="#">JPG to PNG</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">WEBP Converter</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">Resize Image</a></li>
</ul>
</div>
<!-- Document Tools -->
<div class="bg-white p-8 rounded-xl border border-outline-variant ambient-shadow hover:shadow-lg transition-all duration-300">
<div class="text-teal-600 mb-stack-md">
<span class="material-symbols-outlined" style="font-size: 32px;">description</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Document Tools</h4>
<p class="font-body-sm text-body-sm text-secondary mb-4">Professional document formatting and type conversion.</p>
<ul class="space-y-2">
<li><a class="text-body-sm text-primary hover:underline" href="#">Word to PDF</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">Excel to CSV</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">EPUB Converter</a></li>
</ul>
</div>
<!-- Video/Audio -->
<div class="bg-white p-8 rounded-xl border border-outline-variant ambient-shadow hover:shadow-lg transition-all duration-300">
<div class="text-amber-600 mb-stack-md">
<span class="material-symbols-outlined" style="font-size: 32px;">movie_filter</span>
</div>
<h4 class="font-headline-md text-headline-md mb-2">Media Tools</h4>
<p class="font-body-sm text-body-sm text-secondary mb-4">High-fidelity conversion for video and audio streaming formats.</p>
<ul class="space-y-2">
<li><a class="text-body-sm text-primary hover:underline" href="#">MP4 to MP3</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">Video Compressor</a></li>
<li><a class="text-body-sm text-primary hover:underline" href="#">GIF Maker</a></li>
</ul>
</div>
</div>
</section>
<!-- Featured Tools (Asymmetric Layout) -->
<section class="bg-surface-container py-24">
<div class="max-w-container-max mx-auto px-margin-desktop">
<div class="grid grid-cols-1 lg:grid-cols-2 gap-stack-lg items-center">
<div class="relative">
<div class="aspect-video bg-surface-container-highest rounded-2xl overflow-hidden shadow-2xl relative">
<img class="w-full h-full object-cover" data-alt="A clean, corporate workspace with a modern laptop showing a sleek file conversion interface on the screen. The room is filled with soft natural light, and the aesthetic is professional and minimalist, with subtle blue and gray tones. 4k resolution, high quality architectural photography." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkl3IjgJj55MQOT_4qcHzsBuQ4mtD9byNLzUffqMoCncipEDpq2UIms_VXT0-AaujFvmFp3HJ9BuFWFhAYKfwAiLFIGdoX2piwrI_ARBUCgTbV29RGk0tH5VZP6llQceTN67HVAjwzVMN0E-kwnI8d94i3uxTnJPzmj6Q__ZnmJpMTJ5sLK3XCpUPu0qSLIJDrDdFNEJDkeV0J7QTTHYRuJU-b0Apce2Wf0X38W52eAv6ysCIAzB2qfdHtXbs9XFA_dd9Yp5vnr3o"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
<div class="absolute bottom-6 left-6 text-white">
<div class="flex items-center gap-2 mb-2">
<span class="bg-primary-container px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider">Fastest</span>
<span class="bg-white/20 backdrop-blur-sm px-2 py-0.5 rounded text-[10px] uppercase font-bold tracking-wider">Reliable</span>
</div>
<h5 class="text-headline-md font-bold">All Converter In Here</h5>
</div>
</div>
<!-- Decorative Element -->
<div class="absolute -top-6 -right-6 w-32 h-32 bg-primary-fixed-dim/30 rounded-full blur-3xl -z-10"></div>
</div>
<div class="lg:pl-16">
<h2 class="font-headline-lg text-headline-lg text-on-surface mb-stack-md">Why choose All In One Converter?</h2>
<div class="space-y-stack-lg">
<div class="flex gap-stack-md">
<div class="flex-shrink-0 w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-primary">security</span>
</div>
<div>
<h6 class="font-label-md text-label-md text-on-surface">End-to-End Encryption</h6>
<p class="font-body-sm text-body-sm text-secondary">Your files are encrypted during transit and deleted automatically after 2 hours.</p>
</div>
</div>
<div class="flex gap-stack-md">
<div class="flex-shrink-0 w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-primary">text_fields</span>
</div>
<div>
<h6 class="font-label-md text-label-md text-on-surface">Precision OCR Engine</h6>
<p class="font-body-sm text-body-sm text-secondary">Highly accurate optical character recognition for scanned documents.</p>
</div>
</div>
<div class="flex gap-stack-md">
<div class="flex-shrink-0 w-12 h-12 bg-white rounded-lg flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-primary">devices</span>
</div>
<div>
<h6 class="font-label-md text-label-md text-on-surface">Cloud-Based Power</h6>
<p class="font-body-sm text-body-sm text-secondary">Heavy lifting happens on our servers, keeping your device running fast.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- App Features / CTA Section -->
<section class="max-w-container-max mx-auto px-margin-desktop py-stack-lg">
<div class="bg-primary rounded-3xl p-stack-lg md:p-16 text-center text-on-primary overflow-hidden relative">
<!-- Background Decoration -->
<div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
<div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
<div class="relative z-10">
<h2 class="font-headline-lg text-headline-lg mb-stack-md">Ready to optimize your workflow?</h2>
<p class="font-body-lg text-body-lg mb-stack-lg opacity-90 max-w-2xl mx-auto">
                    Join 2 million+ users who trust All In One Converter for their daily file processing needs. No installation required.
                </p>
<div class="flex flex-col sm:flex-row justify-center gap-stack-md">
<button class="bg-transparent border border-white/30 text-white px-10 py-4 rounded-xl font-label-md hover:bg-white/10 transition-colors">Explore API Docs</button>
</div>
</div>
</div>
</section>
<!-- Footer Section -->
<footer class="w-full py-stack-lg bg-surface-container-low border-t border-outline-variant">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter px-margin-desktop max-w-container-max mx-auto">
<div class="flex flex-col">
<div class="text-body-lg font-headline-lg font-bold text-on-surface mb-stack-md">All In One Converter</div>
<p class="font-body-sm text-body-sm text-secondary mb-stack-md">Professional-grade file conversion tools accessible to everyone, anywhere.</p>
<div class="flex gap-stack-sm">
<span class="w-8 h-8 bg-surface-container-highest rounded flex items-center justify-center material-symbols-outlined text-primary cursor-pointer hover:bg-primary hover:text-white transition-all">public</span>
<span class="w-8 h-8 bg-surface-container-highest rounded flex items-center justify-center material-symbols-outlined text-primary cursor-pointer hover:bg-primary hover:text-white transition-all">rss_feed</span>
<span class="w-8 h-8 bg-surface-container-highest rounded flex items-center justify-center material-symbols-outlined text-primary cursor-pointer hover:bg-primary hover:text-white transition-all">mail</span>
</div>
</div>
<div>
<h5 class="font-label-md text-label-md text-on-surface mb-stack-md uppercase tracking-wider">Product</h5>
<ul class="space-y-2">
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">PDF Tools</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Image Converters</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Document Tools</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">API Docs</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md text-label-md text-on-surface mb-stack-md uppercase tracking-wider">Company</h5>
<ul class="space-y-2">
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Blog</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Status</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Contact Support</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Affiliates</a></li>
</ul>
</div>
<div>
<h5 class="font-label-md text-label-md text-on-surface mb-stack-md uppercase tracking-wider">Legal</h5>
<ul class="space-y-2">
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Terms of Service</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Privacy Policy</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">GDPR Compliance</a></li>
<li><a class="font-body-sm text-body-sm text-on-secondary-container hover:text-primary hover:underline transition-all duration-150" href="#">Cookie Settings</a></li>
</ul>
</div>
</div>
<div class="max-w-container-max mx-auto px-margin-desktop mt-12 pt-8 border-t border-outline-variant text-center md:text-left">
<span class="font-label-sm text-label-sm text-secondary">© 2024 All In One Converter. Precision &amp; Efficiency.</span>
</div>
</footer>
</body></html>
