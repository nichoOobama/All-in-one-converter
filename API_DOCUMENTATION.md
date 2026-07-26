# API Documentation - All-in-One Converter

## Overview

REST API untuk integrasi dengan native apps (.NET, Android) dan third-party services.

**Base URL:** `http://localhost:8000/api`

**Content-Type:** `application/json` (kecuali file upload)

---

## Table of Contents

- [File Conversion API](#file-conversion-api)
  - [POST /api/convert](#post-apiconvert)
  - [GET /api/convert/{uuid}/status](#get-apiconvertuuidstatus)
  - [GET /api/convert/{uuid}/download](#get-apiconvertuuiddownload)
- [License API](#license-api)
  - [POST /api/license/verify](#post-apilicenseverify)
- [Version API](#version-api)
  - [GET /api/version](#get-apiversion)
- [Error Codes](#error-codes)
- [Integration Examples](#integration-examples)

---

## File Conversion API

### POST /api/convert

Upload file dan mulai konversi.

**Request:**

```
Content-Type: multipart/form-data
```

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `file` | file | Yes | File yang akan dikonversi |
| `target_format` | string | Yes | Format target (jpg, png, mp4, mp3, pdf, dll) |
| `quality` | int | No | Kualitas output (1-100), default: 85 |
| `bitrate` | string | No | Bitrate audio (128k, 192k, 256k, 320k) |
| `codec` | string | No | Codec video (libx264, libvpx) |
| `crf` | int | No | CRF video (0-51, lower = better quality) |

**Example Request (cURL):**

```bash
curl -X POST http://localhost:8000/api/convert \
  -F "file=@/path/to/image.png" \
  -F "target_format=jpg" \
  -F "quality=90"
```

**Success Response (201):**

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

**Error Response (422):**

```json
{
    "success": false,
    "error": "File is too large for Image conversion. Maximum size: 50MB."
}
```

---

### GET /api/convert/{uuid}/status

Cek status konversi.

**Request:**

```bash
curl http://localhost:8000/api/convert/550e8400-e29b-41d4-a716-446655440000/status
```

**Success Response (200) - Pending:**

```json
{
    "success": true,
    "data": {
        "uuid": "550e8400-e29b-41d4-a716-446655440000",
        "status": "pending",
        "source_filename": "image.png",
        "target_extension": "jpg",
        "category": "image",
        "source_size": 1048576,
        "output_size": null,
        "duration_ms": null,
        "error_message": null,
        "created_at": "2026-07-26T12:00:00.000000Z"
    }
}
```

**Success Response (200) - Completed:**

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

**Error Response (404):**

```json
{
    "error": "Conversion not found"
}
```

---

### GET /api/convert/{uuid}/download

Download file hasil konversi.

**Request:**

```bash
curl -O http://localhost:8000/api/convert/550e8400-e29b-41d4-a716-446655440000/download
```

**Response:** Binary file (download)

**Error Response (400):**

```json
{
    "error": "Conversion not completed"
}
```

---

## License API

### POST /api/license/verify

Verifikasi dan aktivasi license key dari native apps.

**Gunakan endpoint ini untuk:**
- Verifikasi apakah license key valid
- Menandai license sebagai "used" (one-time use)
- Mendapatkan informasi tipe license

**Request:**

```bash
curl -X POST http://localhost:8000/api/license/verify \
  -H "Content-Type: application/json" \
  -d '{"license_key": "A1B2-C3D4-E5F6-G7H8"}'
```

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `license_key` | string | Yes | License key yang akan diverifikasi |

**Success Response (200):**

```json
{
    "success": true,
    "valid": true,
    "message": "License activated successfully.",
    "license": {
        "type": "single",
        "activated_at": "2026-07-26T12:00:00.000000Z"
    }
}
```

**Error Responses:**

**License tidak ditemukan (404):**

```json
{
    "success": false,
    "valid": false,
    "message": "License key not found."
}
```

**License sudah dipakai (422):**

```json
{
    "success": false,
    "valid": false,
    "message": "License has already been used."
}
```

**License expired (422):**

```json
{
    "success": false,
    "valid": false,
    "message": "License has expired."
}
```

**License tidak aktif (422):**

```json
{
    "success": false,
    "valid": false,
    "message": "License is not active."
}
```

---

## Version API

### GET /api/version

Cek versi terbaru dari aplikasi native. Digunakan oleh native apps untuk mengecek apakah ada update tersedia.

**Request:**

```bash
# Without current version (just get latest)
curl "http://localhost:8000/api/version?platform=windows"

# With current version (check if update available)
curl "http://localhost:8000/api/version?platform=windows&current_version=1.0.0"
```

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `platform` | string | Yes | `windows` or `android` |
| `current_version` | string | No | Version installed on user's device |

**Success Response (200) - Update Available:**

```json
{
    "success": true,
    "update_available": true,
    "force_update": false,
    "latest": {
        "version": "1.2.0",
        "release_date": "2026-07-26",
        "download_url": "/downloads/windows/v1.2.0/setup.exe",
        "changelog": [
            "Fixed bug in video conversion",
            "Added support for AVIF format",
            "Performance improvements"
        ],
        "is_critical": false,
        "file_size": 47000000,
        "file_hash": null,
        "min_supported_version": "1.0.0"
    },
    "current_version": "1.0.0"
}
```

**Success Response (200) - No Update:**

```json
{
    "success": true,
    "update_available": false,
    "force_update": false,
    "latest": {
        "version": "1.0.0",
        "release_date": "2026-07-26",
        "download_url": "/downloads/windows/v1.0.0/setup.exe",
        "changelog": ["Initial release"],
        "is_critical": false,
        "file_size": 45000000,
        "file_hash": null,
        "min_supported_version": null
    },
    "current_version": "1.0.0"
}
```

**Success Response (200) - Force Update Required:**

```json
{
    "success": true,
    "update_available": true,
    "force_update": true,
    "latest": {
        "version": "1.3.0",
        "release_date": "2026-08-01",
        "download_url": "/downloads/windows/v1.3.0/setup.exe",
        "changelog": ["Critical security patch"],
        "is_critical": true,
        "file_size": 47500000,
        "file_hash": "sha256:abc123...",
        "min_supported_version": "1.1.0"
    },
    "current_version": "1.0.0"
}
```

**Response Fields:**

| Field | Type | Description |
|-------|------|-------------|
| `update_available` | bool | Apakah ada versi lebih baru |
| `force_update` | bool | Apakah user WAJIB update (block app jika tidak) |
| `latest.version` | string | Nomor versi terbaru |
| `latest.release_date` | string | Tanggal rilis |
| `latest.download_url` | string | URL untuk download |
| `latest.changelog` | array | Daftar perubahan |
| `latest.is_critical` | bool | Update penting (security) |
| `latest.file_size` | int | Ukuran file dalam bytes |
| `latest.file_hash` | string | Hash untuk verifikasi integritas |
| `latest.min_supported_version` | string | Versi minimum yang masih didukung |

---

## Error Codes

| HTTP Code | Description |
|-----------|-------------|
| `200` | Success |
| `201` | Created (conversion started) |
| `400` | Bad request (conversion not ready) |
| `404` | Resource not found |
| `422` | Validation error / business logic error |

---

## Integration Examples

### C# (.NET)

**File Conversion:**

```csharp
using System.Net.Http;
using System.Net.Http.Headers;

public class ConverterService
{
    private readonly HttpClient _client = new();

    public async Task<dynamic> ConvertFile(string filePath, string targetFormat)
    {
        using var form = new MultipartFormDataContent();
        var fileBytes = await File.ReadAllBytesAsync(filePath);
        var fileContent = new ByteArrayContent(fileBytes);
        fileContent.Headers.ContentType = new MediaTypeHeaderValue("application/octet-stream");
        form.Add(fileContent, "file", Path.GetFileName(filePath));
        form.Add(new StringContent(targetFormat), "target_format");

        var response = await _client.PostAsync("http://localhost:8000/api/convert", form);
        return await response.Content.ReadFromJsonAsync<dynamic>();
    }

    public async Task<dynamic> CheckStatus(string uuid)
    {
        var response = await _client.GetAsync($"http://localhost:8000/api/convert/{uuid}/status");
        return await response.Content.ReadFromJsonAsync<dynamic>();
    }
}
```

**License Verification:**

```csharp
public class LicenseService
{
    private readonly HttpClient _client = new();

    public async Task<bool> VerifyLicense(string licenseKey)
    {
        var content = new StringContent(
            JsonSerializer.Serialize(new { license_key = licenseKey }),
            Encoding.UTF8,
            "application/json"
        );

        var response = await _client.PostAsync("http://localhost:8000/api/license/verify", content);
        var result = await response.Content.ReadFromJsonAsync<LicenseResponse>();

        return result?.Valid ?? false;
    }
}

public class LicenseResponse
{
    public bool Success { get; set; }
    public bool Valid { get; set; }
    public string Message { get; set; }
    public LicenseInfo License { get; set; }
}

public class LicenseInfo
{
    public string Type { get; set; }
    public DateTime ActivatedAt { get; set; }
}
```

### Android (Kotlin)

**File Conversion:**

```kotlin
suspend fun convertFile(file: File, targetFormat: String): ConversionResponse {
    val requestBody = MultipartBody.Builder()
        .setType(MultipartBody.FORM)
        .addFormDataPart("file", file.name,
            file.asRequestBody("application/octet-stream".toMediaTypeOrNull()))
        .addFormDataPart("target_format", targetFormat)
        .build()

    val request = Request.Builder()
        .url("http://localhost:8000/api/convert")
        .post(requestBody)
        .build()

    val response = client.newCall(request).execute()
    return Gson().fromJson(response.body?.string(), ConversionResponse::class.java)
}

suspend fun checkStatus(uuid: String): StatusResponse {
    val request = Request.Builder()
        .url("http://localhost:8000/api/convert/$uuid/status")
        .get()
        .build()

    val response = client.newCall(request).execute()
    return Gson().fromJson(response.body?.string(), StatusResponse::class.java)
}
```

**License Verification:**

```kotlin
data class LicenseVerifyRequest(
    val license_key: String
)

data class LicenseResponse(
    val success: Boolean,
    val valid: Boolean,
    val message: String,
    val license: LicenseInfo?
)

data class LicenseInfo(
    val type: String,
    val activated_at: String
)

suspend fun verifyLicense(licenseKey: String): LicenseResponse {
    val body = Gson().toJson(LicenseVerifyRequest(licenseKey))
        .toRequestBody("application/json".toMediaTypeOrNull())

    val request = Request.Builder()
        .url("http://localhost:8000/api/license/verify")
        .post(body)
        .build()

    val response = client.newCall(request).execute()
    return Gson().fromJson(response.body?.string(), LicenseResponse::class.java)
}
```

---

## License Flow for Native Apps

```
┌─────────────────────────────────────────────────────────┐
│                    NATIVE APP FLOW                       │
├─────────────────────────────────────────────────────────┤
│                                                          │
│  1. User buka app                                        │
│     │                                                    │
│     ▼                                                    │
│  2. App minta license key                                │
│     │                                                    │
│     ▼                                                    │
│  3. User masukkan key: ABCD-1234-EFGH-5678               │
│     │                                                    │
│     ▼                                                    │
│  4. App kirim request:                                   │
│     POST /api/license/verify                             │
│     Body: { "license_key": "ABCD-1234-EFGH-5678" }      │
│     │                                                    │
│     ▼                                                    │
│  5. Server cek:                                          │
│     ✓ Key exists?                                        │
│     ✓ Not used before?                                   │
│     ✓ Not expired?                                       │
│     ✓ Status active?                                     │
│     │                                                    │
│     ├─ YES → used=true, return success                   │
│     │        App unlocks pro features                    │
│     │                                                    │
│     └─ NO → return error                                 │
│              App shows error message                     │
│                                                          │
└─────────────────────────────────────────────────────────┘
```

---

## Rate Limiting

- **File conversion:** 50 per IP per day (configurable)
- **License verify:** No limit (one-time use per key)
- **File size:** Varies by category (see documentation)

---

## Postman Collection

Import this into Postman for testing:

```json
{
    "info": {
        "name": "All-in-One Converter API",
        "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
    },
    "item": [
        {
            "name": "Convert File",
            "request": {
                "method": "POST",
                "url": "{{base_url}}/api/convert",
                "body": {
                    "mode": "formdata",
                    "formdata": [
                        { "key": "file", "type": "file" },
                        { "key": "target_format", "value": "jpg", "type": "text" }
                    ]
                }
            }
        },
        {
            "name": "Check Status",
            "request": {
                "method": "GET",
                "url": "{{base_url}}/api/convert/{{uuid}}/status"
            }
        },
        {
            "name": "Download Result",
            "request": {
                "method": "GET",
                "url": "{{base_url}}/api/convert/{{uuid}}/download"
            }
        },
        {
            "name": "Verify License",
            "request": {
                "method": "POST",
                "url": "{{base_url}}/api/license/verify",
                "header": [
                    { "key": "Content-Type", "value": "application/json" }
                ],
                "body": {
                    "mode": "raw",
                    "raw": "{ \"license_key\": \"ABCD-1234-EFGH-5678\" }"
                }
            }
        },
        {
            "name": "Check Version",
            "request": {
                "method": "GET",
                "url": "{{base_url}}/api/version?platform=windows&current_version=1.0.0"
            }
        }
    ],
    "variable": [
        { "key": "base_url", "value": "http://localhost:8000" },
        { "key": "uuid", "value": "" }
    ]
}
```
