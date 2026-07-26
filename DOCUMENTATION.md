# All-in-One File Converter

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Architecture](#architecture)
- [Directory Structure](#directory-structure)
- [Installation & Setup](#installation--setup)
- [System Dependencies](#system-dependencies)
- [Configuration](#configuration)
- [How It Works](#how-it-works)
- [Supported Formats](#supported-formats)
- [Web Interface](#web-interface)
- [Authentication System](#authentication-system)
- [License System](#license-system)
- [Download Page](#download-page)
- [Version Checking](#version-checking)
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

All-in-One Converter adalah aplikasi Laravel untuk mengkonversi berbagai jenis file antar format, dilengkapi dengan sistem lisensi untuk native apps (.NET & Android).

**Core Features:**
- Web-based file converter (image, video, audio, document, spreadsheet, presentation)
- Authentication system (login, register, logout)
- License management (single purchase & subscription)
- Download page for native apps
- REST API for native apps integration (.NET, Android)

---

## Features

### File Conversion
- **Image** - jpg, jpeg, png, webp, gif, bmp, tiff, ico
- **Video** - mp4, avi, mkv, mov, webm, flv, wmv, gif
- **Audio** - mp3, wav, flac, aac, ogg, m4a, wma
- **Document** - pdf, docx, doc, odt, txt, html, rtf
- **Spreadsheet** - xlsx, xls, csv, ods, tsv
- **Presentation** - pptx, ppt, odp

### User System
- Registration & Login
- Dashboard with license overview
- View & copy license keys

### License System
- Single purchase (lifetime)
- Subscription (monthly)
- One-time use verification via API
- License tied to user account

### Native Apps
- Download page for Windows & Android
- License activation in-app
- Offline conversion support

---

## Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                    FRONTEND (Blade HTML)                         │
│  Auth → Converter → Dashboard → Licenses → Download              │
└──────────────────────────────┬──────────────────────────────────┘
                               │ HTTP / API
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: INTERFACE                             │
│  Auth Controllers → Conversion Controllers → License Controllers │
│  API Controllers (for native apps)                               │
└──────────────────────────────┬──────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: APPLICATION                           │
│  Services → DTOs → Jobs → Events → Enums                         │
└──────────────────────────────┬──────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: DOMAIN                                │
│  ConverterInterface → ConverterRegistry → FileCategory Enum      │
│  License Model → User Model                                      │
└──────────────────────────────┬──────────────────────────────────┘
                               │
┌──────────────────────────────▼──────────────────────────────────┐
│                     LAYER: INFRASTRUCTURE                        │
│  Drivers (GD/FFmpeg/LibreOffice)                                  │
│  Storage (local) → Queue (database) → Auth (session-based)       │
└─────────────────────────────────────────────────────────────────┘
```

---

## Directory Structure

```
all-in-one-converter/
├── app/
│   ├── Contracts/
│   │   ├── ConverterInterface.php
│   │   ├── FileValidatorInterface.php
│   │   └── TemporaryFileManagerInterface.php
│   │
│   ├── DTOs/
│   │   ├── ConversionRequest.php
│   │   └── ConversionResult.php
│   │
│   ├── Enums/
│   │   ├── ConversionStatus.php
│   │   └── FileCategory.php
│   │
│   ├── Exceptions/
│   │   ├── FileTooLargeException.php
│   │   ├── SameFormatException.php
│   │   └── UnsupportedFormatException.php
│   │
│   ├── Converters/
│   │   ├── ImageConverter.php
│   │   ├── VideoConverter.php
│   │   ├── AudioConverter.php
│   │   ├── DocumentConverter.php
│   │   ├── SpreadsheetConverter.php
│   │   └── PresentationConverter.php
│   │
│   ├── Services/
│   │   ├── ConversionService.php
│   │   ├── ConverterRegistry.php
│   │   ├── FileValidator.php
│   │   └── TemporaryFileManager.php
│   │
│   ├── Jobs/
│   │   ├── ConvertFileJob.php
│   │   └── CleanupTempFilesJob.php
│   │
│   ├── Events/
│   │   ├── ConversionStarted.php
│   │   ├── ConversionCompleted.php
│   │   └── ConversionFailed.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Conversion.php
│   │   ├── License.php          ← NEW
│   │   └── Version.php          ← NEW
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   └── AuthController.php          ← NEW
│   │   │   ├── ConversionController.php
│   │   │   ├── DownloadController.php          ← NEW
│   │   │   ├── LicenseController.php           ← NEW
│   │   │   └── Api/
│   │   │       ├── ApiConversionController.php
│   │   │       ├── ApiLicenseController.php    ← NEW
│   │   │       └── ApiVersionController.php    ← NEW
│   │   │
│   │   └── Middleware/
│   │       ├── EnsureUserLoggedIn.php          ← NEW
│   │       └── RedirectIfAuthenticated.php     ← NEW
│   │
│   └── Providers/
│       └── ConverterServiceProvider.php
│
├── config/
│   └── converter.php
│
├── database/
│   └── migrations/
│       ├── 2026_07_26_000001_create_conversions_table.php
│       ├── 2026_07_26_000002_create_licenses_table.php    ← NEW
│       └── 2026_07_26_000003_create_versions_table.php    ← NEW
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php                   ← NEW
│       ├── auth/
│       │   ├── login.blade.php                 ← NEW
│       │   └── register.blade.php              ← NEW
│       ├── dashboard/
│       │   └── index.blade.php                 ← NEW
│       ├── converter/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       ├── download/
│       │   └── index.blade.php                 ← NEW
│       ├── pricing/
│       │   └── index.blade.php                 ← NEW
│       ├── checkout/
│       │   └── index.blade.php                 ← NEW
│       └── licenses/
│           ├── index.blade.php                 ← NEW
│           └── show.blade.php                  ← NEW
│
├── routes/
│   ├── web.php
│   ├── api.php
│   └── dashboard.php                           ← NEW
│
├── DOCUMENTATION.md
└── API_DOCUMENTATION.md                        ← NEW
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

# Terminal 2: Queue Worker
php artisan queue:work --queue=conversions

# Terminal 3: Scheduler
php artisan schedule:work
```

---

## System Dependencies

| Tool | Purpose | Install |
|------|---------|---------|
| **PHP GD** | Image conversion | Usually pre-installed |
| **FFmpeg** | Video & audio conversion | `apt install ffmpeg` |
| **LibreOffice** | Document conversion | `apt install libreoffice-core` |

---

## Configuration

File: `config/converter.php`

```php
return [
    'disk' => env('CONVERTER_DISK', 'local'),
    'temp_disk' => env('CONVERTER_TEMP_DISK', 'local'),
    'temp_lifetime_hours' => env('CONVERTER_TEMP_LIFETIME_HOURS', 24),

    'queue' => [
        'connection' => env('CONVERTER_QUEUE_CONNECTION', 'database'),
        'queue' => env('CONVERTER_QUEUE', 'conversions'),
    ],

    'limits' => [
        'per_user_daily' => env('CONVERTER_DAILY_LIMIT', 50),
        'max_file_size_mb' => env('CONVERTER_MAX_FILE_SIZE_MB', 2048),
    ],

    'drivers' => [
        'ffmpeg' => env('FFMPEG_PATH', 'ffmpeg'),
        'ffprobe' => env('FFPROBE_PATH', 'ffprobe'),
        'libreoffice' => env('LIBREOFFICE_PATH', '/usr/bin/soffice'),
        'ghostscript' => env('GHOSTSCRIPT_PATH', 'gs'),
    ],

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

---

## How It Works

### File Conversion Flow

```
User uploads file (requires login)
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
│  ConvertFileJob  │
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

### License Verification Flow

```
Native App requests license verification
       │
       ▼
POST /api/license/verify
Body: { "license_key": "ABCD-1234-EFGH-5678" }
       │
       ▼
┌──────────────────┐
│ Server checks:   │
│ ✓ Key exists?    │
│ ✓ Not used?      │
│ ✓ Not expired?   │
│ ✓ Active status? │
└────────┬─────────┘
         │
    ┌────┴────┐
    │         │
    ▼         ▼
  VALID     INVALID
    │         │
    ▼         ▼
Mark as    Return error
used       to app
```

---

## Supported Formats

### Image (GD)
**Options:** `quality` (1-100, default: 85)

| Source | Target |
|--------|--------|
| jpg, jpeg, png, webp, gif, bmp | jpg, jpeg, png, webp, gif, bmp |

### Video (FFmpeg)
**Options:** `codec`, `crf`, `preset`, `fps`, `width`, `start_time`, `duration`

| Source | Target |
|--------|--------|
| mp4, avi, mkv, mov, webm, flv, wmv | mp4, avi, mkv, mov, webm, gif |

### Audio (FFmpeg)
**Options:** `bitrate`, `sample_rate`, `start_time`, `duration`

| Source | Target |
|--------|--------|
| mp3, wav, flac, aac, ogg, m4a, wma | mp3, wav, flac, aac, ogg, m4a, wma |

### Document (LibreOffice)

| Source | Target |
|--------|--------|
| docx, doc, odt, rtf, pdf | pdf, docx, doc, odt, txt, html, rtf |

### Spreadsheet (LibreOffice)

| Source | Target |
|--------|--------|
| xlsx, xls, ods, pdf | xlsx, xls, csv, ods, tsv, pdf |

### Presentation (LibreOffice)

| Source | Target |
|--------|--------|
| pptx, ppt, odp, pdf | pptx, ppt, odp, pdf |

---

## Web Interface

### Pages

| URL | Auth Required | Description |
|-----|---------------|-------------|
| `GET /` | No | Redirects to converter |
| `GET /convert` | Yes | Upload form + recent conversions |
| `POST /convert` | Yes | Process upload |
| `GET /convert/{uuid}` | Yes | Status page (auto-refresh) |
| `GET /convert/{uuid}/download` | Yes | Download converted file |
| `DELETE /convert/{uuid}` | Yes | Delete conversion |
| `GET /download` | No | Download native apps page |
| `GET /pricing` | No | Pricing plans |
| `GET /login` | No | Login form |
| `POST /login` | No | Process login |
| `GET /register` | No | Register form |
| `POST /register` | No | Process registration |
| `POST /logout` | Yes | Logout |
| `GET /dashboard` | Yes | User dashboard |
| `GET /licenses` | Yes | List user licenses |
| `GET /licenses/{key}` | Yes | License detail |
| `GET /checkout/{plan}` | Yes | Checkout page |
| `POST /checkout/{plan}` | Yes | Process checkout |

---

## Authentication System

### Features
- Registration with name, email, password
- Login with email & password
- Remember me option
- Session-based authentication
- Middleware protection for protected routes

### Files

| File | Purpose |
|------|---------|
| `Auth/AuthController.php` | Login, register, logout |
| `Middleware/EnsureUserLoggedIn.php` | Redirect to login if not authenticated |
| `Middleware/RedirectIfAuthenticated.php` | Redirect to dashboard if already logged in |
| `views/auth/login.blade.php` | Login form |
| `views/auth/register.blade.php` | Register form |

---

## License System

### License Types

| Type | Duration | Price | Features |
|------|----------|-------|----------|
| **Single** | Lifetime | $9.99 | One device, unlimited conversions |
| **Subscription** | Monthly | $4.99/mo | 3 devices, priority support |

### License Flow

1. **User registers/logs in**
2. **Visits /pricing** - chooses plan
3. **Goes to /checkout/{plan}** - fills form (demo payment)
4. **License created** with unique key (format: XXXX-XXXX-XXXX-XXXX)
5. **License shown** at /licenses/{key}
6. **User copies key** and enters in native app
7. **Native app calls API** to verify and activate

### Database

**Table: licenses**

| Column | Type | Description |
|--------|------|-------------|
| `id` | bigint | Primary key |
| `user_id` | bigint | FK to users |
| `license_key` | string(19) | Unique key (XXXX-XXXX-XXXX-XXXX) |
| `type` | enum | `single` or `subscription` |
| `status` | enum | `active`, `used`, `expired` |
| `used_at` | timestamp | When activated in native app |
| `expires_at` | timestamp | For subscription only |
| `created_at` | timestamp | Purchase date |
| `updated_at` | timestamp | Last update |

---

## Download Page

**URL:** `/download`

Content:
- Brief description of native apps
- Windows download link (.exe installer)
- Android download link (.apk file)
- License activation instructions
- System requirements

---

## Version Checking

Native apps dapat mengecek versi terbaru via API endpoint.

**Endpoint:** `GET /api/version`

**Parameters:**
| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `platform` | string | Yes | `windows` or `android` |
| `current_version` | string | No | Versi yang terinstall |

**Flow:**

```
App Start → GET /api/version?platform=windows&current_version=1.0.0
                │
                ├─ update_available: true
                │   └─ Show "Update Available" dialog
                │
                ├─ force_update: true
                │   └─ BLOCK app, force user to update
                │
                └─ update_available: false
                    └─ Continue normally
```

**Database:** `versions` table stores version info per platform

**Adding New Version:**

```php
use App\Models\Version;

Version::create([
    'version_number' => '1.1.0',
    'platform' => 'windows',
    'download_url' => '/downloads/windows/v1.1.0/setup.exe',
    'changelog' => ['Bug fixes', 'New features'],
    'is_critical' => false,
    'force_update' => false,
    'min_supported_version' => '1.0.0',
    'file_size' => 47000000,
    'is_active' => true,
]);
```

**Full API documentation:** [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

---

## REST API

### Base URL
```
http://localhost:8000/api
```

### Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/api/convert` | Upload & convert file |
| `GET` | `/api/convert/{uuid}/status` | Check conversion status |
| `GET` | `/api/convert/{uuid}/download` | Download converted file |
| `POST` | `/api/license/verify` | Verify & activate license |
| `GET` | `/api/version` | Check for app updates |

### Quick Example

```bash
# Convert file
curl -X POST http://localhost:8000/api/convert \
  -F "file=@image.png" \
  -F "target_format=jpg"

# Check status
curl http://localhost:8000/api/convert/{uuid}/status

# Verify license
curl -X POST http://localhost:8000/api/license/verify \
  -H "Content-Type: application/json" \
  -d '{"license_key": "ABCD-1234-EFGH-5678"}'
```

**Full API documentation:** [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

---

## Queue & Job System

| Job | Queue | Timeout | Purpose |
|-----|-------|---------|---------|
| `ConvertFileJob` | conversions | 3600s | Process file conversion |
| `CleanupTempFilesJob` | default | 300s | Hourly temp file cleanup |

```bash
# Start queue worker
php artisan queue:work --queue=conversions
```

---

## File Validation & Security

| Category | Max Size |
|----------|----------|
| Image | 50 MB |
| Video | 2,000 MB |
| Audio | 200 MB |
| Document | 100 MB |
| Spreadsheet | 50 MB |
| Presentation | 100 MB |

---

## Error Handling

| Exception | When |
|-----------|------|
| `FileTooLargeException` | File exceeds category limit |
| `SameFormatException` | Source = target format |
| `UnsupportedFormatException` | Target not supported |

---

## Adding New Converters

1. Create `app/Converters/NewConverter.php` implementing `ConverterInterface`
2. Add case to `app/Enums/FileCategory.php`
3. Register in `app/Providers/ConverterServiceProvider.php`
4. Add formats to `config/converter.php`

---

## Database Schema

### conversions

| Column | Type |
|--------|------|
| id | bigint |
| uuid | uuid (unique) |
| source_filename | string |
| source_mime_type | string |
| source_extension | string(10) |
| source_size | bigint |
| target_extension | string(10) |
| category | string(20) |
| status | string(20) |
| error_message | text (nullable) |
| output_path | string (nullable) |
| output_size | bigint (nullable) |
| duration_ms | int (nullable) |
| options | json (nullable) |
| ip_address | string(45) |
| created_at | timestamp |
| updated_at | timestamp |
| deleted_at | timestamp (nullable) |

### licenses

| Column | Type |
|--------|------|
| id | bigint |
| user_id | bigint (FK) |
| license_key | string(19) (unique) |
| type | enum (single, subscription) |
| status | enum (active, used, expired) |
| used_at | timestamp (nullable) |
| expires_at | timestamp (nullable) |
| created_at | timestamp |
| updated_at | timestamp |

### versions

| Column | Type |
|--------|------|
| id | bigint |
| version_number | string(20) |
| platform | enum (windows, android) |
| download_url | string |
| changelog | json (nullable) |
| is_critical | boolean |
| force_update | boolean |
| min_supported_version | string(20) (nullable) |
| file_size | bigint (nullable) |
| file_hash | string(64) (nullable) |
| is_active | boolean |
| created_at | timestamp |
| updated_at | timestamp |

---

## Deployment Notes

```bash
# Production checklist
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set APP_DEBUG=false in .env
# Use Redis for queue: QUEUE_CONNECTION=redis
# Set up Supervisor for queue worker
# Set up cron for scheduler
```

---

## License

MIT License
