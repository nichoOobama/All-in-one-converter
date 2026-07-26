<?php

return array (
  'disk' => 'local',
  'temp_disk' => 'local',
  'temp_lifetime_hours' => 2,
  'queue' => 
  array (
    'connection' => 'database',
    'queue' => 'conversions',
  ),
  'limits' => 
  array (
    'per_user_daily' => 50,
    'max_file_size_mb' => 2048,
  ),
  'drivers' => 
  array (
    'ffmpeg' => 'ffmpeg',
    'ffprobe' => 'ffprobe',
    'libreoffice' => '/usr/bin/soffice',
    'ghostscript' => 'gs',
  ),
  'formats' => 
  array (
    'image' => 
    array (
      0 => 'jpg',
      1 => 'jpeg',
      2 => 'png',
      3 => 'webp',
      4 => 'gif',
      5 => 'bmp',
      6 => 'tiff',
      7 => 'ico',
    ),
    'video' => 
    array (
      0 => 'mp4',
      1 => 'avi',
      2 => 'mkv',
      3 => 'mov',
      4 => 'webm',
      5 => 'flv',
      6 => 'wmv',
      7 => 'gif',
    ),
    'audio' => 
    array (
      0 => 'mp3',
      1 => 'wav',
      2 => 'flac',
      3 => 'aac',
      4 => 'ogg',
      5 => 'm4a',
      6 => 'wma',
    ),
    'document' => 
    array (
      0 => 'pdf',
      1 => 'docx',
      2 => 'doc',
      3 => 'odt',
      4 => 'txt',
      5 => 'html',
      6 => 'rtf',
    ),
    'spreadsheet' => 
    array (
      0 => 'xlsx',
      1 => 'xls',
      2 => 'csv',
      3 => 'ods',
      4 => 'tsv',
    ),
    'presentation' => 
    array (
      0 => 'pptx',
      1 => 'ppt',
      2 => 'odp',
    ),
    'archive' => 
    array (
      0 => 'zip',
      1 => 'tar',
      2 => 'gz',
      3 => 'rar',
      4 => '7z',
    ),
  ),
  'mime_types' => 
  array (
    'image' => 
    array (
      'jpg' => 'image/jpeg',
      'jpeg' => 'image/jpeg',
      'png' => 'image/png',
      'webp' => 'image/webp',
      'gif' => 'image/gif',
      'bmp' => 'image/bmp',
      'tiff' => 'image/tiff',
      'ico' => 'image/x-icon',
    ),
    'video' => 
    array (
      'mp4' => 'video/mp4',
      'avi' => 'video/x-msvideo',
      'mkv' => 'video/x-matroska',
      'mov' => 'video/quicktime',
      'webm' => 'video/webm',
      'flv' => 'video/x-flv',
      'wmv' => 'video/x-ms-wmv',
    ),
    'audio' => 
    array (
      'mp3' => 'audio/mpeg',
      'wav' => 'audio/wav',
      'flac' => 'audio/flac',
      'aac' => 'audio/aac',
      'ogg' => 'audio/ogg',
      'm4a' => 'audio/mp4',
      'wma' => 'audio/x-ms-wma',
    ),
    'document' => 
    array (
      'pdf' => 'application/pdf',
      'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
      'doc' => 'application/msword',
      'odt' => 'application/vnd.oasis.opendocument.text',
      'txt' => 'text/plain',
      'html' => 'text/html',
      'rtf' => 'application/rtf',
    ),
    'spreadsheet' => 
    array (
      'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      'xls' => 'application/vnd.ms-excel',
      'csv' => 'text/csv',
      'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
      'tsv' => 'text/tab-separated-values',
    ),
    'presentation' => 
    array (
      'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
      'ppt' => 'application/vnd.ms-powerpoint',
      'odp' => 'application/vnd.oasis.opendocument.presentation',
    ),
    'archive' => 
    array (
      'zip' => 'application/zip',
      'tar' => 'application/x-tar',
      'gz' => 'application/gzip',
      'rar' => 'application/vnd.rar',
      '7z' => 'application/x-7z-compressed',
    ),
  ),
);
