# All-in-One File Converter

## Table of Contents

- [Overview](#overview)
- [Architecture](#architecture)
- [Directory Structure](#directory-structure)
- [Installation & Setup](#installation--setup)
- [System Dependencies](#system-dependencies)
- [Configuration](#configuration)
- [How It Works](#how-it-works)
- [Supported Formats](#supported-formats)
- [Web Interface](#web-interface)
- [REST API](#rest-api)
- [Queue & Job System](#queue--job-system)
- [File Validation & Security](#file-validation--security)
- [Temporary File Management](#temporary-file-management)
- [Error Handling](#error-handling)
- [Adding New Converters](#adding-new-converters)
- [Database Schema](#database-schema)
- [Deployment Notes](#deployment-notes)

---

## Overview

All-in-One Converter adalah aplikasi Laravel untuk mengkonversi berbagai jenis file antar format, meliputi:

- **Image** - jpg, jpeg, png, webp, gif, bmp, tiff, ico
- **Video** - mp4, avi, mkv, mov, webm, flv, wmv, gif
- **Audio** - mp3, wav, flac, aac, ogg, m4a, wma
- **Document** - pdf, docx, doc, odt, txt, html, rtf
- **Spreadsheet** - xlsx, xls, csv, ods, tsv
- **Presentation** - pptx, ppt, odp

Aplikasi ini menggunakan arsitektur **Strategy Pattern + Factory Pattern** yang memungkinkan penambahan converter baru tanpa mengubah kode yang sudah ada.

---

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                        FRONTEND (Blade HTML)                    │
│  Upload → Select Format → Track Progress → Download             │
└──────────────────────────────┬──────────────────────────────────┘
                               │ HTTP / API
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: INTERFACE                            │
│  Controllers → FormRequests → API Resources                     │
└──────────────────────────────┬──────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: APPLICATION                          │
│  ConversionService → DTOs → Jobs → Events                       │
└──────────────────────────────┬──────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: DOMAIN                               │
│  ConverterInterface → ConverterRegistry → FileCategory Enum     │
│  FileValidator → ConversionResult ValueObject                   │
└──────────────────────────────┬──────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: INFRASTRUCTURE                       │
│  Drivers (GD/FFmpeg/LibreOffice)                                │
│  Storage (local) → Queue (database) → Temp File Manager         │
└─────────────────────────────────────────────────────────────────┘
```

### Design Patterns Used

| Pattern | Where | Purpose |
|---------|-------|---------|
| **Strategy Pattern** | `ConverterInterface` + converters | Setiap kategori punya strategi konversi sendiri |
| **Factory Pattern** | `ConverterRegistry` | Resolve converter berdasarkan kategori file |
| **Service Pattern** | `ConversionService` | Orchestrate seluruh alur konversi |
| **DTO Pattern** | `ConversionRequest`, `ConversionResult` | Transfer data tanpa dependensi framework |
| **Repository Pattern** | `Conversion` model | Abstract data access layer |
| **Event Pattern** | `ConversionStarted/Completed/Failed` | Decouple notification & logging |

---

## Directory Structure

```
all-in-one-converter/
├── app/
│   ├── Contracts/                    # Interface definitions
│   │   ├── ConverterInterface.php    # Contract untuk semua converter
│   │   ├── FileValidatorInterface.php
│   │   └── TemporaryFileManagerInterface.php
│   │
│   ├── DTOs/                         # Data Transfer Objects
│   │   ├── ConversionRequest.php     # Input: file, target format, options
│   │   └── ConversionResult.php      # Output: path, size, duration
│   │
│   ├── Enums/                        # Type-safe enumerations
│   │   ├── FileCategory.php          # image, video, audio, document, etc.
│   │   └── ConversionStatus.php      # pending, processing, completed, failed
│   │
│   ├── Exceptions/                   # Custom exception classes
│   │   ├── FileTooLargeException.php
│   │   ├── SameFormatException.php
│   │   └── UnsupportedFormatException.php
│   │
│   ├── Converters/                   # Converter implementations
│   │   ├── ImageConverter.php        # GD-based image conversion
│   │   ├── VideoConverter.php        # FFmpeg-based video conversion
│   │   ├── AudioConverter.php        # FFmpeg-based audio conversion
│   │   ├── DocumentConverter.php     # LibreOffice document conversion
│   │   ├── SpreadsheetConverter.php  # LibreOffice spreadsheet conversion
│   │   └── PresentationConverter.php # LibreOffice presentation conversion
│   │
│   ├── Services/                     # Business logic layer
│   │   ├── ConversionService.php     # Main orchestrator
│   │   ├── ConverterRegistry.php     # Maps category → converter
│   │   ├── FileValidator.php         # Validates files before conversion
│   │   └── TemporaryFileManager.php  # Manages temp files & cleanup
│   │
│   ├── Jobs/                         # Queue jobs
│   │   ├── ConvertFileJob.php        # Main async conversion job
│   │   └── CleanupTempFilesJob.php   # Scheduled cleanup job
│   │
│   ├── Events/                       # Event classes
│   │   ├── ConversionStarted.php
│   │   ├── ConversionCompleted.php
│   │   └── ConversionFailed.php
│   │
│   ├── Models/
│   │   └── Conversion.php            # Eloquent model
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── ConversionController.php      # Web routes
│   │   │   └── Api/
│   │   │       └── ApiConversionController.php  # API routes
│   │   └── Requests/                          # (reserved for future)
│   │
│   └── Providers/
│       └── ConverterServiceProvider.php  # Register all bindings
│
├── config/
│   └── converter.php                # Main configuration file
│
├── database/
│   └── migrations/
│       └── 2026_07_26_000001_create_conversions_table.php
│
├── resources/
│   └── views/
│       └── converter/
│           ├── index.blade.php      # Upload form + recent conversions
│           └── show.blade.php       # Conversion status page
│
├── routes/
│   ├── web.php                      # Web routes
│   └── api.php                      # API routes
│
└── DOCUMENTATION.md                 # This file
```

---

## Installation & Setup

### Prerequisites

- PHP 8.3+
- Laravel 13
- Composer
- Node.js (for npm)

### Step 1: Clone & Install

```bash
git clone <repository-url>
cd all-in-one-converter
composer install
cp .env.example .env
php artisan key:generate
npm install
```

### Step 2: Database Setup

```bash
# Using SQLite (default)
touch database/database.sqlite
php artisan migrate

# Or using MySQL
# Edit .env:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=converter
# DB_USERNAME=root
# DB_PASSWORD=
php artisan migrate
```

### Step 3: Storage Link

```bash
php artisan storage:link
```

### Step 4: Install System Dependencies

```bash
# Ubuntu/Debian
sudo apt update
sudo apt install ffmpeg libreoffice ghostscript

# macOS
brew install ffmpeg libreoffice ghostscript

# Windows
# Install FFmpeg: https://ffmpeg.org/download.html
# Install LibreOffice: https://www.libreoffice.org/download/
# Add both to PATH
```

### Step 5: Start the Application

```bash
# Terminal 1: Web Server
php artisan serve

# Terminal 2: Queue Worker (for async conversion)
php artisan queue:work --queue=conversions

# Terminal 3: Scheduler (for cleanup)
php artisan schedule:work
```

---

## System Dependencies

### Required

| Tool | Purpose | Install |
|------|---------|---------|
| **PHP GD Extension** | Image conversion (jpg, png, webp, gif, bmp) | Usually pre-installed with PHP |
| **FFmpeg** | Video & audio conversion | `apt install ffmpeg` or `brew install ffmpeg` |
| **LibreOffice** | Document, spreadsheet, presentation conversion | `apt install libreoffice-core` |

### Optional

| Tool | Purpose | Install |
|------|---------|---------|
| **Imagick** | Advanced image processing | `pecl install imagick` |
| **GhostScript** | PDF compression/processing | `apt install ghostscript` |

### Check Installation

```bash
# Check PHP GD
php -m | grep gd

# Check FFmpeg
ffmpeg -version

# Check LibreOffice
libreoffice --version

# Check GhostScript
gs --version
```

---

## Configuration

Configuration file: `config/converter.php`

```php
return [
    // Storage disk for converted files
    'disk' => env('CONVERTER_DISK', 'local'),

    // Temporary disk for input/output files
    'temp_disk' => env('CONVERTER_TEMP_DISK', 'local'),

    // Hours before temp files are auto-deleted
    'temp_lifetime_hours' => env('CONVERTER_TEMP_LIFETIME_HOURS', 24),

    // Queue configuration
    'queue' => [
        'connection' => env('CONVERTER_QUEUE_CONNECTION', 'database'),
        'queue' => env('CONVERTER_QUEUE', 'conversions'),
    ],

    // Rate limiting
    'limits' => [
        'per_user_daily' => env('CONVERTER_DAILY_LIMIT', 50),
        'max_file_size_mb' => env('CONVERTER_MAX_FILE_SIZE_MB', 2048),
    ],

    // System tool paths
    'drivers' => [
        'ffmpeg' => env('FFMPEG_PATH', 'ffmpeg'),
        'ffprobe' => env('FFPROBE_PATH', 'ffprobe'),
        'libreoffice' => env('LIBREOFFICE_PATH', '/usr/bin/soffice'),
        'ghostscript' => env('GHOSTSCRIPT_PATH', 'gs'),
    ],

    // Supported formats per category
    'formats' => [
        'image' => ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'tiff', 'ico'],
        'video' => ['mp4', 'avi', 'mkv', 'mov', 'webm', 'flv', 'wmv', 'gif'],
        'audio' => ['mp3', 'wav', 'flac', 'aac', 'ogg', 'm4a', 'wma'],
        'document' => ['pdf', 'docx', 'doc', 'odt', 'txt', 'html', 'rtf'],
        'spreadsheet' => ['xlsx', 'xls', 'csv', 'ods', 'tsv'],
        'presentation' => ['pptx', 'ppt', 'odp'],
    ],
];
```

### Environment Variables (.env)

```env
# Database
DB_CONNECTION=sqlite

# Queue
QUEUE_CONNECTION=database

# Converter settings
CONVERTER_DISK=local
CONVERTER_TEMP_DISK=local
CONVERTER_TEMP_LIFETIME_HOURS=24
CONVERTER_DAILY_LIMIT=50
CONVERTER_MAX_FILE_SIZE_MB=2048

# System tools (adjust paths for your OS)
FFMPEG_PATH=ffmpeg
FFPROBE_PATH=ffprobe
LIBREOFFICE_PATH=/usr/bin/soffice
GHOSTSCRIPT_PATH=gs
```

---

## How It Works

### Flow Diagram

```
User uploads file
       │
       ▼
┌──────────────────┐
│ ConversionService│
│   → validate()   │
│   → store temp   │
│   → create DB    │
│   → dispatch job │
└────────┬─────────┘
         │
         ▼
┌──────────────────┐
│  ConvertFileJob  │  (runs in queue worker)
│   → resolve      │
│     converter    │
│   → execute      │
│   → save result  │
│   → update DB    │
└────────┬─────────┘
         │
         ▼
┌──────────────────┐
│  User polls      │
│  status page     │
│  → downloads     │
│    when done     │
└──────────────────┘
```

### Step-by-Step Process

1. **Upload**: User uploads a file and selects target format via web form or API.

2. **Validation**: `FileValidator` checks:
   - MIME type is valid
   - File size is within limits for the category
   - Target format is supported
   - Source ≠ target format

3. **Storage**: File is saved to temporary directory: `storage/app/conversions/{id}/input/`

4. **Job Dispatch**: `ConvertFileJob` is dispatched to the queue.

5. **Conversion**: The job:
   - Resolves the correct converter via `ConverterRegistry`
   - Creates output directory: `storage/app/conversions/{id}/output/`
   - Executes the conversion using the appropriate driver
   - Saves the output file

6. **Status Update**: Job updates `conversions` table with:
   - `status`: completed/failed
   - `output_path`: relative path to converted file
   - `output_size`: file size in bytes
   - `duration_ms`: conversion time in milliseconds

7. **Download**: User can download the converted file.

8. **Cleanup**: `CleanupTempFilesJob` runs hourly to delete expired temp files.

---

## Supported Formats

### Image (GD Extension)

| Source | Target | Notes |
|--------|--------|-------|
| jpg, jpeg | png, webp, gif, bmp | Direct conversion |
| png | jpg, jpeg, webp, gif, bmp | Transparent → white background |
| webp | jpg, jpeg, png, gif, bmp | Decode WebP |
| gif | jpg, jpeg, png, webp, bmp | First frame only |
| bmp | jpg, jpeg, png, webp, gif | Direct conversion |

**Options**: `quality` (1-100, default: 85)

### Video (FFmpeg)

| Source | Target | Notes |
|--------|--------|-------|
| mp4, avi, mkv, mov, webm, flv, wmv | mp4, avi, mkv, mov, webm | Full transcoding |
| mp4, avi, mkv, mov, webm | gif | Animated GIF extraction |

**Options**:
- `codec`: libx264 (default), libvpx (for webm)
- `crf`: 0-51 (default: 23, lower = better quality)
- `preset`: ultrafast, fast, medium (default), slow
- `fps`: frames per second for GIF (default: 10)
- `width`: width for GIF (default: 480)
- `start_time`: start time (e.g., "00:00:10")
- `duration`: duration (e.g., "00:01:00")

### Audio (FFmpeg)

| Source | Target | Notes |
|--------|--------|-------|
| mp3, wav, flac, aac, ogg, m4a, wma | mp3, wav, flac, aac, ogg, m4a | Full transcoding |

**Options**:
- `bitrate`: 128k, 192k (default), 256k, 320k
- `sample_rate`: 44100, 48000, etc.
- `start_time`: start time
- `duration`: duration

### Document (LibreOffice)

| Source | Target | Notes |
|--------|--------|-------|
| docx, doc, odt, rtf | pdf | Document to PDF |
| docx, doc, odt | txt | Text extraction |
| docx, doc, odt | html | HTML conversion |
| pdf | docx, doc, odt | PDF to document |

### Spreadsheet (LibreOffice)

| Source | Target | Notes |
|--------|--------|-------|
| xlsx, xls, ods | csv | Spreadsheet to CSV |
| xlsx, xls, ods | tsv | Tab-separated values |
| xlsx, xls, ods | pdf | Spreadsheet to PDF |

### Presentation (LibreOffice)

| Source | Target | Notes |
|--------|--------|-------|
| pptx, ppt, odp | pdf | Presentation to PDF |
| pptx, ppt, odp | odp | Format conversion |

---

## Web Interface

### Pages

| URL | Description |
|-----|-------------|
| `GET /` | Redirects to `/convert` |
| `GET /convert` | Upload form + recent conversions list |
| `POST /convert` | Process upload and start conversion |
| `GET /convert/{uuid}` | Show conversion status (auto-refresh) |
| `GET /convert/{uuid}/download` | Download converted file |
| `DELETE /convert/{uuid}` | Delete conversion |

### Auto-Refresh

Status page (`/convert/{uuid}`) auto-refreshes every 3 seconds while conversion is pending/processing.

---

## REST API

### POST /api/convert

Upload a file and start conversion.

**Request**:
```bash
curl -X POST http://localhost:8000/api/convert \
  -F "file=@/path/to/image.png" \
  -F "target_format=jpg"
```

**Response** (201):
```json
{
    "success": true,
    "data": {
        "uuid": "550e8400-e29b-41d4-a716-446655440000",
        "status": "pending",
        "source_filename": "image.png",
        "target_extension": "jpg",
        "category": "image",
        "status_url": "http://localhost:8000/api/convert/550e8400-e29b-41d4-a716-446655440000/status"
    }
}
```

### GET /api/convert/{uuid}/status

Check conversion status.

**Request**:
```bash
curl http://localhost:8000/api/convert/550e8400-e29b-41d4-a716-446655440000/status
```

**Response** (200):
```json
{
    "success": true,
    "data": {
        "uuid": "550e8400-e29b-41d4-a716-446655440000",
        "status": "completed",
        "source_filename": "image.png",
        "target_extension": "jpg",
        "category": "image",
        "source_size": 1048576,
        "output_size": 524288,
        "duration_ms": 1200,
        "error_message": null,
        "created_at": "2026-07-26T12:00:00.000000Z",
        "download_url": "http://localhost:8000/api/convert/550e8400-e29b-41d4-a716-446655440000/download"
    }
}
```

### GET /api/convert/{uuid}/download

Download converted file.

**Request**:
```bash
curl -O http://localhost:8000/api/convert/550e8400-e29b-41d4-a716-446655440000/download
```

### Error Response

```json
{
    "success": false,
    "error": "File is too large for Video conversion. Maximum size: 2000MB."
}
```

---

## Queue & Job System

### ConvertFileJob

| Property | Value |
|----------|-------|
| **Queue** | `conversions` |
| **Tries** | 3 |
| **Timeout** | 3600 seconds (1 hour) |
| **Retry** | On failure, retries 3 times |

### CleanupTempFilesJob

| Property | Value |
|----------|-------|
| **Schedule** | Hourly |
| **Timeout** | 300 seconds (5 minutes) |
| **Action** | Deletes temp directories older than configured lifetime |

### Queue Configuration

```bash
# Start queue worker
php artisan queue:work --queue=conversions

# With Redis (recommended for production)
QUEUE_CONNECTION=redis
php artisan queue:work --queue=conversions

# Monitor failed jobs
php artisan queue:failed
php artisan queue:retry all
```

---

## File Validation & Security

### Validation Rules

1. **MIME Type Detection**: Uses `mime_content_type()` to detect actual file type (not just extension).

2. **File Size Limits** (per category):

| Category | Max Size |
|----------|----------|
| Image | 50 MB |
| Video | 2,000 MB (2 GB) |
| Audio | 200 MB |
| Document | 100 MB |
| Spreadsheet | 50 MB |
| Presentation | 100 MB |

3. **Format Validation**: Target format must be in the supported list for the file's category.

4. **Same Format Check**: Prevents converting to the same format.

### Security Considerations

- Files are stored in `storage/app/conversions/{id}/` (not publicly accessible)
- Only the IP address that uploaded the file sees it in "Recent Conversions"
- No user authentication required (public access)
- Temporary files are auto-cleaned after configurable TTL

---

## Temporary File Management

### Directory Structure

```
storage/app/
└── conversions/
    ├── {id}/
    │   ├── input/
    │   │   └── original-file.ext
    │   └── output/
    │       └── converted-file.ext
    ├── {id}/
    │   ├── input/
    │   │   └── ...
    │   └── output/
    │       └── ...
    └── ...
```

### Cleanup

- **Automatic**: `CleanupTempFilesJob` runs hourly
- **Manual**: Use `TemporaryFileManager::cleanupExpired()` method
- **Lifetime**: Configurable via `CONVERTER_TEMP_LIFETIME_HOURS` (default: 24 hours)

---

## Error Handling

### Exception Classes

| Exception | When |
|-----------|------|
| `FileTooLargeException` | File exceeds category size limit |
| `SameFormatException` | Source and target formats are the same |
| `UnsupportedFormatException` | Target format not supported for this category |
| `RuntimeException` | Driver execution failed (FFmpeg, LibreOffice, etc.) |

### Error Response (API)

```json
{
    "success": false,
    "error": "File is too large for Video conversion. Maximum size: 2000MB."
}
```

### Error Response (Web)

Redirects back with error message in session:
```
/errors?file=File+is+too+large+for+Video+conversion.+Maximum+size:+2000MB.
```

### Failed Jobs

Failed queue jobs are logged in the `failed_jobs` table:

```bash
# View failed jobs
php artisan queue:failed

# Retry a specific failed job
php artisan queue:retry {id}

# Retry all failed jobs
php artisan queue:retry all
```

---

## Adding New Converters

### Step 1: Create Converter Class

Create a new file in `app/Converters/`:

```php
<?php

namespace App\Converters;

use App\Contracts\ConverterInterface;
use App\DTOs\ConversionRequest;
use App\DTOs\ConversionResult;
use App\Enums\FileCategory;

class ArchiveConverter implements ConverterInterface
{
    public function convert(
        ConversionRequest $request,
        string $sourcePath,
        string $outputDir
    ): ConversionResult {
        $start = microtime(true);

        // Your conversion logic here
        $outputFilename = pathinfo(
            $request->file->getClientOriginalName(),
            PATHINFO_FILENAME
        ) . '.' . $request->targetFormat;

        $outputPath = $outputDir . '/' . $outputFilename;

        // Execute conversion (e.g., using exec, Process, etc.)
        // exec("your-tool ...");

        $durationMs = (int) ((microtime(true) - $start) * 1000);

        return new ConversionResult(
            outputPath: $outputPath,
            outputFilename: $outputFilename,
            fileSize: filesize($outputPath),
            durationMs: $durationMs,
            outputMimeType: 'application/zip',
        );
    }

    public function supportedFormats(): array
    {
        return ['zip', 'tar', 'gz', 'rar'];
    }

    public function category(): FileCategory
    {
        return FileCategory::Archive;
    }

    public function canConvert(
        string $sourceExtension,
        string $targetExtension
    ): bool {
        return in_array($sourceExtension, $this->supportedFormats())
            && in_array($targetExtension, $this->supportedFormats());
    }
}
```

### Step 2: Add to FileCategory Enum

Add a new case in `app/Enums/FileCategory.php`:

```php
enum FileCategory: string
{
    // ... existing cases
    case Archive = 'archive';

    public function label(): string
    {
        return match ($this) {
            // ... existing cases
            self::Archive => 'Archive',
        };
    }

    public function maxSizeBytes(): int
    {
        return match ($this) {
            // ... existing cases
            self::Archive => 500_000_000, // 500MB
        };
    }
}
```

### Step 3: Register in ConverterServiceProvider

Add to `app/Providers/ConverterServiceProvider.php`:

```php
use App\Converters\ArchiveConverter;

$registry->register(new ArchiveConverter());
```

### Step 4: Add Formats to Config

Add to `config/converter.php`:

```php
'formats' => [
    // ... existing formats
    'archive' => ['zip', 'tar', 'gz', 'rar'],
],
```

---

## Database Schema

### Table: conversions

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint (PK) | Auto-increment ID |
| `uuid` | uuid (unique) | Public identifier |
| `source_filename` | string | Original filename |
| `source_mime_type` | string | MIME type |
| `source_extension` | string(10) | File extension |
| `source_size` | bigint | File size in bytes |
| `target_extension` | string(10) | Target format |
| `category` | string(20) | File category |
| `status` | string(20) | pending/processing/completed/failed |
| `error_message` | text (nullable) | Error details |
| `output_path` | string (nullable) | Relative path to converted file |
| `output_size` | bigint (nullable) | Converted file size |
| `duration_ms` | int (nullable) | Conversion duration |
| `options` | json (nullable) | Conversion options |
| `ip_address` | string(45) (nullable) | Client IP |
| `created_at` | timestamp | Created time |
| `updated_at` | timestamp | Updated time |
| `deleted_at` | timestamp (nullable) | Soft delete |

### Indexes

- `uuid` (unique)
- `status + created_at` (composite)
- `category`

---

## Deployment Notes

### Production Checklist

1. **Set APP_DEBUG=false** in `.env`

2. **Use Redis** for queue:
   ```
   QUEUE_CONNECTION=redis
   ```

3. **Install system dependencies**:
   ```bash
   apt install ffmpeg libreoffice ghostscript
   ```

4. **Set up Supervisor** for queue worker:
   ```ini
   [program:converter-worker]
   command=php artisan queue:work --queue=conversions --tries=3
   autostart=true
   autorestart=true
   stopasgroup=true
   killasgroup=true
   ```

5. **Set up cron** for scheduler:
   ```bash
   * * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
   ```

6. **Configure storage**:
   ```bash
   php artisan storage:link
   ```

7. **Set file permissions**:
   ```bash
   chown -R www-data:www-data storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   ```

### Performance Tips

- Use **Redis** instead of database queue for better performance
- Increase `maxProcesses` for queue worker if needed
- Use **S3** for storage if scaling horizontally
- Monitor queue length with `php artisan queue:size`

### Scaling

```bash
# Multiple workers
php artisan queue:work --queue=conversions --tries=3
php artisan queue:work --queue=conversions --tries=3
php artisan queue:work --queue=conversions --tries=3
```

---

## License

MIT License
