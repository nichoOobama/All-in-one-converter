@extends(Auth::check() ? 'layouts.app' : 'layouts.landing')

@section('content')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('file-input');
        const defaultView = document.getElementById('drop-zone-default');
        const previewView = document.getElementById('drop-zone-preview');
        const previewFilename = document.getElementById('preview-filename');
        const previewSize = document.getElementById('preview-size');
        const previewCategory = document.getElementById('preview-category');
        const previewIcon = document.getElementById('preview-icon');
        const changeFileBtn = document.getElementById('change-file-btn');
        const formatSelect = document.getElementById('target_format');

        if (!dropZone || !fileInput || !defaultView || !previewView) return;

        const allFormatGroups = Array.from(document.querySelectorAll('#target_format optgroup'));
        const placeholderOption = '<option value="">Select Format</option>';

        function filterFormats(category) {
            formatSelect.innerHTML = placeholderOption;
            allFormatGroups.forEach(group => {
                if (!category || group.dataset.category === category) {
                    formatSelect.appendChild(group.cloneNode(true));
                }
            });
        }

        const categoryByExt = {};
        document.querySelectorAll('#target_format optgroup').forEach(group => {
            const category = group.dataset.category;
            group.querySelectorAll('option').forEach(option => {
                categoryByExt[option.value.toLowerCase()] = category;
            });
        });

        const categoryLabels = {
            image: 'Image', video: 'Video', audio: 'Audio', document: 'Document',
            spreadsheet: 'Spreadsheet', presentation: 'Presentation'
        };

        const categoryIcons = {
            image: 'image', video: 'movie', audio: 'music_note',
            document: 'description', spreadsheet: 'table_chart', presentation: 'slideshow'
        };

        function formatSize(bytes) {
            if (!bytes) return '0 B';
            const units = ['B', 'KB', 'MB', 'GB', 'TB'];
            let i = 0;
            while (bytes >= 1024 && i < units.length - 1) { bytes /= 1024; i++; }
            return bytes.toFixed(i === 0 ? 0 : 1) + ' ' + units[i];
        }

        function getCategory(ext) {
            return categoryByExt[ext.toLowerCase()] || null;
        }

        function showPreview(file) {
            if (!file) return;
            previewFilename.textContent = file.name;
            previewSize.textContent = formatSize(file.size);
            const ext = file.name.split('.').pop();
            const category = getCategory(ext);
            previewCategory.textContent = category
                ? categoryLabels[category] + ' file detected — we\u2019ll convert automatically'
                : 'Format not recognized — pick a target manually';
            previewIcon.textContent = category ? categoryIcons[category] : 'description';
            filterFormats(category);
            formatSelect.value = '';
            defaultView.classList.add('hidden');
            previewView.classList.remove('hidden');
            dropZone.classList.add('border-primary', 'bg-primary-container/5');
        }

        function resetView() {
            fileInput.value = '';
            filterFormats(null);
            formatSelect.value = '';
            defaultView.classList.remove('hidden');
            previewView.classList.add('hidden');
            dropZone.classList.remove('border-primary', 'bg-primary-container/5');
        }

        fileInput.addEventListener('change', function () {
            if (fileInput.files && fileInput.files.length > 0) {
                showPreview(fileInput.files[0]);
            }
        });

        changeFileBtn.addEventListener('click', e => {
            e.stopPropagation();
            resetView();
            fileInput.click();
        });

        let dragDepth = 0;
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
                if (eventName === 'dragenter') dragDepth++;
                dropZone.classList.add('border-primary', 'bg-primary-container/5');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, e => {
                e.preventDefault();
                e.stopPropagation();
                if (eventName === 'dragleave' && --dragDepth <= 0) {
                    dragDepth = 0;
                    dropZone.classList.remove('border-primary', 'bg-primary-container/5');
                }
                if (eventName === 'drop') {
                    dragDepth = 0;
                    dropZone.classList.remove('border-primary', 'bg-primary-container/5');
                }
            });
        });

        dropZone.addEventListener('drop', e => {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                showPreview(files[0]);
            }
        });

        document.addEventListener('dragover', e => e.preventDefault());
        document.addEventListener('drop', e => e.preventDefault());
    });
</script>
<!-- Main Content Canvas -->
<main class="flex-grow flex flex-col items-center py-stack-lg px-margin-mobile md:px-margin-desktop">
<div class="max-w-container-max w-full">
<!-- Tool Header -->
<div class="mb-stack-lg text-center md:text-left">
<h1 class="font-headline-lg text-headline-lg text-on-surface mb-stack-sm">Convert Your Files Here</h1>
<p class="font-body-lg text-body-lg text-secondary max-w-2xl">Convert any file to your desired format with high precision and fast processing.</p>
</div>
<!-- Bento Layout Content -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
<!-- Primary Action Area: Drop Zone -->
<div class="lg:col-span-8 flex flex-col gap-gutter">
<form action="{{ route('convert.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
<div class="relative group bg-surface-container-lowest border-2 border-dashed border-outline-variant rounded-xl p-stack-lg min-h-[400px] flex flex-col items-center justify-center transition-all duration-300 hover:border-primary hover:bg-surface-container-low cursor-pointer" id="drop-zone">
<div class="text-center" id="drop-zone-default">
<div class="mb-stack-lg inline-flex items-center justify-center w-20 h-20 rounded-full bg-primary-container/10 text-primary">
<span class="material-symbols-outlined text-[48px]">upload_file</span>
</div>
<h2 class="font-headline-md text-headline-md text-on-surface mb-stack-sm">Drop your files here</h2>
<p class="font-body-md text-body-md text-secondary">or click to select from your device.</p>
<p class="font-body-md text-body-md text-secondary mb-stack-lg">Don't worry, you dont need to manually select the format category, we'll do it for you.</p>
<button type="button" id="upload-btn" class="bg-primary text-on-primary px-10 py-4 rounded-lg font-headline-md text-body-md hover:shadow-lg transform transition-all active:scale-95">
                                Upload Files
                            </button>
</div>
<div class="hidden text-center" id="drop-zone-preview">
<div class="absolute top-4 right-4 w-8 h-8 rounded-full bg-green-100 text-green-600 flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-[20px]">check_circle</span>
</div>
<span class="material-symbols-outlined text-[48px] text-primary mb-stack-sm" id="preview-icon">description</span>
<h2 class="font-headline-md text-headline-md text-on-surface mb-stack-sm" id="preview-filename"></h2>
<p class="font-body-md text-body-md text-secondary mb-stack-sm" id="preview-size"></p>
<p class="text-label-sm text-primary mb-stack-md" id="preview-category"></p>
<button type="button" id="change-file-btn" class="relative z-10 text-primary font-label-md hover:underline">Change file</button>
</div>
<input type="file" name="file" id="file-input" class="absolute inset-0 opacity-0 cursor-pointer" required/>
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

    <optgroup label="Images" data-category="image">
        @foreach ($formats['image'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Video" data-category="video">
        @foreach ($formats['video'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Audio" data-category="audio">
        @foreach ($formats['audio'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Documents" data-category="document">
        @foreach ($formats['document'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Spreadsheets" data-category="spreadsheet">
        @foreach ($formats['spreadsheet'] ?? [] as $fmt)
            <option value="{{ $fmt }}">{{ strtoupper($fmt) }}</option>
        @endforeach
    </optgroup>

    <optgroup label="Presentations" data-category="presentation">
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
@endsection

{{-- 

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
</html> --}}
