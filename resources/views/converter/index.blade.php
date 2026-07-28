<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>PDF to Word | All In One Converter</title>
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
        .drop-zone-active {
            @apply border-primary bg-surface-container-high ring-2 ring-primary ring-opacity-20;
        }
        .shimmer {
            background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
<!-- TopNavBar -->
<nav class="w-full h-16 bg-surface-container-lowest dark:bg-surface-dim border-b border-outline-variant dark:border-on-tertiary-container shadow-sm dark:shadow-none z-50 sticky top-0">
<div class="flex justify-between items-center px-margin-desktop max-w-container-max mx-auto h-full">
<div class="flex items-center gap-stack-lg">
<span class="text-headline-md font-headline-md font-bold text-primary dark:text-primary-fixed-dim">All In One Converter</span>
</div>
<div class="flex items-center gap-stack-md">
<button class="bg-primary text-on-primary px-stack-lg py-2 rounded-lg font-label-md text-label-md hover:opacity-90 transition-opacity">
                    Login
                </button>
</div>
</div>
</nav>
<!-- Main Content Canvas -->
<main class="flex-grow flex flex-col items-center py-stack-lg px-margin-mobile md:px-margin-desktop">
<div class="max-w-container-max w-full">
<!-- Tool Header -->
<div class="mb-stack-lg text-center md:text-left">
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-stack-sm">Convert Your Files Here</h1>
<p class="font-body-lg text-body-lg text-secondary max-w-2xl">Convert your documents to editable Microsoft Word files with high precision and layout preservation.</p>
</div>
<!-- Bento Layout Content -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Primary Action Area: Drop Zone -->
<div class="lg:col-span-8 flex flex-col gap-gutter">
<div class="relative group bg-surface-container-lowest border-2 border-dashed border-outline-variant rounded-xl p-stack-lg min-h-[400px] flex flex-col items-center justify-center transition-all duration-300 hover:border-primary hover:bg-surface-container-low cursor-pointer" id="drop-zone">
<div class="text-center">
<div class="mb-stack-lg inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-container/10 text-primary">
<span class="material-symbols-outlined text-[48px]">upload_file</span>
</div>
<h2 class="font-headline-md text-headline-md text-on-surface mb-stack-sm">Drop PDF files here</h2>
<p class="font-body-md text-body-md text-secondary mb-stack-lg">or click to select from your device</p>
<button class="bg-primary text-on-primary px-10 py-4 rounded-lg font-headline-md text-body-md hover:shadow-lg transform transition-all active:scale-95">
                                Upload Files
                            </button>
<form action="{{ route('convert.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
</div>
<input class="absolute inset-0 opacity-0 cursor-pointer" type="file" required/>
</div>
<!-- Progress Section (Hidden by default, shown via JS simulation) -->
<div class="hidden bg-white border border-outline-variant rounded-xl p-stack-lg shadow-sm" id="conversion-progress">
<div class="flex items-center justify-between mb-stack-md">
<div class="flex items-center gap-stack-md">
<span class="material-symbols-outlined text-primary">description</span>
<div>
<p class="font-label-md text-on-surface">Annual_Financial_Report_2023.pdf</p>
<p class="text-label-sm text-secondary">4.2 MB</p>
</div>
</div>
<span class="font-label-md text-primary" id="progress-percent">0%</span>
</div>
<div class="h-2 w-full bg-surface-container rounded-full overflow-hidden">
<div class="h-full bg-primary transition-all duration-500 w-0" id="progress-bar"></div>
</div>
<div class="mt-stack-md flex justify-between items-center">
<span class="text-label-sm text-secondary flex items-center gap-2" id="status-text">
<span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                                Converting to Word...
                            </span>
<button class="text-error font-label-sm hover:underline">Cancel</button>
</div>
</div>
<!-- Result Section (Hidden by default) -->
<div class="hidden bg-primary-container/5 border border-primary/20 rounded-xl p-stack-lg shadow-sm" id="result-section">
<div class="flex flex-col md:flex-row items-center justify-between gap-stack-lg">
<div class="flex items-center gap-stack-lg">
<div class="w-16 h-16 bg-success/10 text-success bg-green-50 text-green-600 rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-[32px]">check_circle</span>
</div>
<div>
<h3 class="font-label-md text-on-surface">Conversion Complete!</h3>
<p class="text-body-sm text-secondary">Annual_Financial_Report_2023.docx</p>
</div>
</div>
<div class="flex gap-stack-md">
<button class="bg-primary text-on-primary px-8 py-3 rounded-lg font-label-md flex items-center gap-2 hover:opacity-90">
<span class="material-symbols-outlined">download</span> Download File
                                </button>
<button class="p-3 border border-outline-variant rounded-lg hover:bg-white text-secondary">
<span class="material-symbols-outlined">share</span>
</button>
</div>
</div>
</div>
</div>
<!-- Secondary Options & Related Tools -->
<div class="lg:col-span-4 flex flex-col gap-gutter">
<!-- Conversion Settings Card -->
<div class="bg-white border border-outline-variant rounded-xl p-stack-lg shadow-sm">
<h3 class="font-label-md text-on-surface mb-stack-md flex items-center gap-2">
<span class="material-symbols-outlined text-[20px]">settings</span>
                            Conversion Settings
                        </h3>
<div class="space-y-stack-md">
<div>
<label class="block text-label-sm text-secondary mb-stack-sm">Layout Recognition</label>
<select class="w-full bg-surface-container-low border-none rounded-lg font-body-sm focus:ring-2 focus:ring-primary">
<option>Standard (Preserve Layout)</option>
<option>Text Only (Fastest)</option>
<option>Fixed Position</option>
</select>
</div>
<div class="flex items-center justify-between py-2">
<div class="flex flex-col">
<span class="text-label-md text-on-surface">Enable OCR</span>
<span class="text-label-sm text-secondary">For scanned documents</span>
</div>
<label class="relative inline-flex items-center cursor-pointer">
<input class="sr-only peer" type="checkbox"/>
<div class="w-11 h-6 bg-surface-container rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
</label>
</div>
<div>
<label class="block text-label-sm text-secondary mb-stack-sm">Convert To</label>
<div class="flex gap-2">
<select name="target_format" id="target_format" required>
    <option value="">Select Format</option>

    <optgroup label="Images">
        @foreach ($formats['image'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Video">
        @foreach ($formats['video'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Audio">
        @foreach ($formats['audio'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Documents">
        @foreach ($formats['document'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Spreadsheets">
        @foreach ($formats['spreadsheet'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Presentations">
        @foreach ($formats['presentation'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>
</select>

    <button type="submit" class="bg-primary text-on-primary px-10 py-4 rounded-lg font-headline-md text-body-md hover:shadow-lg transform transition-all active:scale-95">Convert</button>
</form>
</div>
</div>
</div>
</div>

<!-- Security Badge -->
<div class="flex items-center gap-stack-md p-stack-md bg-white border border-outline-variant rounded-xl">
<span class="material-symbols-outlined text-green-600">shield</span>
<p class="text-label-sm text-secondary">Your files are encrypted and automatically deleted after 2 hours.</p>
</div>
</div>
</div>
<!-- Features Grid -->
<section class="mt-20">
<h2 class="font-headline-md text-headline-md text-center mb-10">Why use All In One Converter?</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<div class="p-stack-lg bg-white border border-outline-variant rounded-xl hover:shadow-md transition-shadow">
<span class="material-symbols-outlined text-primary mb-stack-sm text-[32px]">bolt</span>
<h4 class="font-label-md text-on-surface mb-stack-sm">Ultra-Fast Processing</h4>
<p class="text-body-sm text-secondary">Convert large files in seconds using our cloud-optimized conversion engine.</p>
</div>
<div class="p-stack-lg bg-white border border-outline-variant rounded-xl hover:shadow-md transition-shadow">
<span class="material-symbols-outlined text-primary mb-stack-sm text-[32px]">layers</span>
<h4 class="font-label-md text-on-surface mb-stack-sm">Layout Retention</h4>
<p class="text-body-sm text-secondary">Our advanced AI ensures your document layout, fonts, and tables remain intact.</p>
</div>
<div class="p-stack-lg bg-white border border-outline-variant rounded-xl hover:shadow-md transition-shadow">
<span class="material-symbols-outlined text-primary mb-stack-sm text-[32px]">lock</span>
<h4 class="font-label-md text-on-surface mb-stack-sm">Secure &amp; Private</h4>
<p class="text-body-sm text-secondary">SSL encryption and automatic file deletion ensure your data remains your own.</p>
</div>
</div>
</section>
</div>
</main>
<!-- Footer -->
<footer class="w-full py-stack-lg bg-surface-container-low dark:bg-inverse-surface border-t border-outline-variant dark:border-on-tertiary-container mt-20">
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter px-margin-desktop max-w-container-max mx-auto">
<div class="flex flex-col gap-stack-sm">
<span class="text-body-lg font-headline-lg font-bold text-on-surface dark:text-inverse-on-surface">All In One Converter</span>
<p class="text-body-sm text-on-secondary-container dark:text-on-secondary-fixed-variant max-w-[240px]">© 2024 All In One Converter. Precision &amp; Efficiency.</p>
</div>
<div class="flex flex-col gap-2">
<span class="font-label-md text-primary mb-2">Tools</span>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">PDF Tools</a>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">Image Converters</a>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">Document Tools</a>
</div>
<div class="flex flex-col gap-2">
<span class="font-label-md text-primary mb-2">Company</span>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">About Us</a>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">Privacy Policy</a>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">Terms of Service</a>
</div>
<div class="flex flex-col gap-2">
<span class="font-label-md text-primary mb-2">Support</span>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">Contact Support</a>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">API Docs</a>
<a class="text-label-sm text-on-secondary-container hover:underline hover:text-primary transition-all" href="#">Status</a>
</div>
</div>
</footer>
<script>
        // Micro-interactions and simulation for conversion process
        const dropZone = document.getElementById('drop-zone');
        const progressSection = document.getElementById('conversion-progress');
        const progressBar = document.getElementById('progress-bar');
        const progressPercent = document.getElementById('progress-percent');
        const resultSection = document.getElementById('result-section');
        const fileInput = dropZone.querySelector('input');

        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                simulateConversion();
            }
        });

        function simulateConversion() {
            dropZone.classList.add('hidden');
            progressSection.classList.remove('hidden');
            
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 100) progress = 100;
                
                progressBar.style.width = `${progress}%`;
                progressPercent.innerText = `${Math.floor(progress)}%`;

                if (progress === 100) {
                    clearInterval(interval);
                    setTimeout(() => {
                        progressSection.classList.add('hidden');
                        resultSection.classList.remove('hidden');
                    }, 500);
                }
            }, 300);
        }

        // Drag and drop visual state
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                dropZone.classList.add('drop-zone-active');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                dropZone.classList.remove('drop-zone-active');
            }, false);
        });

        dropZone.addEventListener('drop', e => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length > 0) {
                simulateConversion();
            }
        });
    </script>
</body></html>

<!-- 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All-in-One Converter</title>
</head>
<body>
    <h1>All-in-One File Converter</h1>

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

    @if (session('success'))
        <div style="border: 1px solid green; padding: 10px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <h2>Upload & Convert</h2>
    

        <div>
            <label for="file">Select File:</label><br>
            <input type="file" name="file" id="file" required>
        </div>

        <div>
            <label for="target_format">Convert To:</label><br>
            <select name="target_format" id="target_format" required>
                <option value="">-- Select Format --</option>

                <optgroup label="Images">
                    @foreach ($formats['image'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Video">
                    @foreach ($formats['video'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Audio">
                    @foreach ($formats['audio'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Documents">
                    @foreach ($formats['document'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Spreadsheets">
                    @foreach ($formats['spreadsheet'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>

                <optgroup label="Presentations">
                    @foreach ($formats['presentation'] ?? [] as $fmt)
                        <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        <br>
        <button type="submit">Convert</button>
    </form>

    <hr>

    <h2>Recent Conversions</h2>
    @if ($recentConversions->isEmpty())
        <p>No conversions yet.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>File</th>
                    <th>Source</th>
                    <th>Target</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentConversions as $conversion)
                    <tr>
                        <td>{{ $conversion->source_filename }}</td>
                        <td>{{ strtoupper($conversion->source_extension) }}</td>
                        <td>{{ strtoupper($conversion->target_extension) }}</td>
                        <td>{{ $conversion->category }}</td>
                        <td>{{ $conversion->status->value }}</td>
                        <td>
                            <a href="{{ route('convert.show', $conversion->uuid) }}">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html> -->
