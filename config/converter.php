<?php

return [

    'disk' => env('CONVERTER_DISK', 'local'),

    'temp_disk' => env('CONVERTER_TEMP_DISK', 'local'),

    'temp_lifetime_hours' => (int) env('CONVERTER_TEMP_LIFETIME_HOURS', 24),

    'queue' => [
        'connection' => env('CONVERTER_QUEUE_CONNECTION', 'database'),
        'queue' => env('CONVERTER_QUEUE', 'conversions'),
    ],

    'limits' => [
        'per_user_daily' => (int) env('CONVERTER_DAILY_LIMIT', 50),
        'max_file_size_mb' => (int) env('CONVERTER_MAX_FILE_SIZE_MB', 2048),
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
        'archive' => ['zip', 'tar', 'gz', 'rar', '7z'],
    ],

    'mime_types' => [
        'image' => [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'webp' => 'image/webp',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'tiff' => 'image/tiff',
            'ico' => 'image/x-icon',
        ],
        'video' => [
            'mp4' => 'video/mp4',
            'avi' => 'video/x-msvideo',
            'mkv' => 'video/x-matroska',
            'mov' => 'video/quicktime',
            'webm' => 'video/webm',
            'flv' => 'video/x-flv',
            'wmv' => 'video/x-ms-wmv',
        ],
        'audio' => [
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
            'flac' => 'audio/flac',
            'aac' => 'audio/aac',
            'ogg' => 'audio/ogg',
            'm4a' => 'audio/mp4',
            'wma' => 'audio/x-ms-wma',
        ],
        'document' => [
            'pdf' => 'application/pdf',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'doc' => 'application/msword',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'txt' => 'text/plain',
            'html' => 'text/html',
            'rtf' => 'application/rtf',
        ],
        'spreadsheet' => [
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'xls' => 'application/vnd.ms-excel',
            'csv' => 'text/csv',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
            'tsv' => 'text/tab-separated-values',
        ],
        'presentation' => [
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'ppt' => 'application/vnd.ms-powerpoint',
            'odp' => 'application/vnd.oasis.opendocument.presentation',
        ],
        'archive' => [
            'zip' => 'application/zip',
            'tar' => 'application/x-tar',
            'gz' => 'application/gzip',
            'rar' => 'application/vnd.rar',
            '7z' => 'application/x-7z-compressed',
        ],
    ],

];