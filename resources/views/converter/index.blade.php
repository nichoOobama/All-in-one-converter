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
<!-- Daily Limit Card - Rapi & Informatif -->
<div class="bg-white border {{ $isLimitReached ? 'border-error/30' : 'border-outline-variant' }} rounded-xl p-stack-lg shadow-sm">
    <div class="flex items-center justify-between mb-stack-sm">
        <h3 class="font-label-md text-on-surface flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px] {{ $isLimitReached ? 'text-error' : 'text-primary' }}">{{ $isLimitReached ? 'block' : 'pie_chart' }}</span>
            Penggunaan Harian
        </h3>
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium {{ $isLimitReached ? 'bg-error-container text-on-error-container' : 'bg-primary-container/10 text-primary border border-primary/10' }}">
            <span class="w-1.5 h-1.5 rounded-full {{ $isLimitReached ? 'bg-error' : 'bg-primary' }} animate-pulse"></span>
            Free • {{ $dailyLimit }}/hari
        </span>
    </div>

    {{-- Angka utama --}}
    <div class="flex items-baseline justify-between mb-stack-sm">
        <div class="flex items-baseline gap-1">
            <span class="text-[28px] font-bold leading-none {{ $isLimitReached ? 'text-error' : 'text-on-surface' }}">{{ $conversionsToday }}</span>
            <span class="text-body-sm text-secondary">/ {{ $dailyLimit }} terpakai</span>
        </div>
        <span class="font-label-md {{ $remaining === 0 ? 'text-error' : ($remaining <= 2 ? 'text-amber-600' : 'text-primary') }}">
            Sisa {{ $remaining }}
        </span>
    </div>

    {{-- Progress bar --}}
    <div class="h-2 w-full bg-surface-container rounded-full overflow-hidden mb-stack-sm">
        <div class="h-full rounded-full transition-all duration-500 {{ $isLimitReached ? 'bg-error' : ($usagePercent >= 80 ? 'bg-amber-500' : 'bg-primary') }}" style="width: {{ $usagePercent }}%"></div>
    </div>

    <div class="flex items-center justify-between">
        <p class="text-label-sm text-secondary flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[14px]">schedule</span>
            Reset jam 00:00 WIB
        </p>
        <p class="text-label-sm {{ $isLimitReached ? 'text-error font-medium' : 'text-secondary' }}">
            {{ $usagePercent }}% terpakai
        </p>
    </div>

    @if($isLimitReached)
        <div class="mt-stack-md p-3 rounded-lg bg-error-container/50 border border-error/20 flex gap-2">
            <span class="material-symbols-outlined text-error text-[18px] mt-0.5">warning</span>
            <div class="flex-1">
                <p class="text-label-sm font-medium text-on-error-container">Batas harian tercapai</p>
                <p class="text-label-sm text-secondary mt-0.5">Upgrade untuk konversi tanpa batas atau tunggu reset besok.</p>
            </div>
        </div>
        <a href="{{ route('pricing') }}" class="mt-stack-sm w-full inline-flex items-center justify-center gap-2 bg-primary text-on-primary px-4 py-2.5 rounded-lg font-label-md text-sm hover:opacity-90 transition-opacity">
            <span class="material-symbols-outlined text-[16px]">diamond</span> Lihat Paket Pro
        </a>
    @elseif($remaining <= 2 && $remaining > 0)
        <div class="mt-stack-md p-3 rounded-lg bg-amber-50 border border-amber-200 flex gap-2">
            <span class="material-symbols-outlined text-amber-600 text-[18px] mt-0.5">info</span>
            <p class="text-label-sm text-amber-800">Sisa {{ $remaining }} lagi hari ini. <a href="{{ route('pricing') }}" class="underline font-medium hover:text-amber-900">Upgrade untuk unlimited →</a></p>
        </div>
    @endif

    @if(!Auth::check())
        <p class="mt-stack-sm text-[11px] leading-4 text-secondary bg-surface-container/50 border border-outline-variant/50 rounded-lg px-3 py-2 flex gap-1.5">
            <span class="material-symbols-outlined text-[14px] mt-0.5">info</span>
            <span>Belum login? Limit dihitung <b>per IP</b> ({{ request()->ip() }}). <a href="{{ route('login') }}" class="text-primary underline font-medium">Login</a> untuk tracking lebih akurat.</span>
        </p>
    @endif
</div>

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

    <button type="submit" @if($isLimitReached) disabled @endif class="px-6 py-3 rounded-lg font-label-md text-sm whitespace-nowrap transition-all flex items-center justify-center gap-1.5 {{ $isLimitReached ? 'bg-surface-container text-secondary cursor-not-allowed border border-outline-variant' : 'bg-primary text-on-primary hover:shadow-lg active:scale-95' }}">
                    @if($isLimitReached)
                        <span class="material-symbols-outlined text-[16px]">block</span> Limit Habis
                    @else
                        Convert
                    @endif
                </button>
</form>
</div>
</div>
        @if($isLimitReached)
        <p class="text-label-sm text-error mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">error</span> Batas 7 konversi/hari tercapai. Coba lagi besok atau upgrade.</p>
        @endif
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
