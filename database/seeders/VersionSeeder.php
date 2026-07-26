<?php

namespace Database\Seeders;

use App\Models\Version;
use Illuminate\Database\Seeder;

class VersionSeeder extends Seeder
{
    public function run(): void
    {
        $versions = [
            [
                'version_number' => '1.0.0',
                'platform' => 'windows',
                'download_url' => '/downloads/windows/v1.0.0/setup.exe',
                'changelog' => ['Initial release', 'Image conversion (jpg, png, webp, gif)', 'Video conversion (mp4, avi, mkv)', 'Audio conversion (mp3, wav, flac)', 'Document conversion (pdf, docx, xlsx)'],
                'is_critical' => false,
                'force_update' => false,
                'min_supported_version' => null,
                'file_size' => 45000000,
                'is_active' => true,
            ],
            [
                'version_number' => '1.0.0',
                'platform' => 'android',
                'download_url' => '/downloads/android/v1.0.0/app.apk',
                'changelog' => ['Initial release', 'Image conversion (jpg, png, webp, gif)', 'Video conversion (mp4, avi, mkv)', 'Audio conversion (mp3, wav, flac)', 'Document conversion (pdf, docx, xlsx)'],
                'is_critical' => false,
                'force_update' => false,
                'min_supported_version' => null,
                'file_size' => 25000000,
                'is_active' => true,
            ],
        ];

        foreach ($versions as $version) {
            Version::updateOrCreate(
                ['version_number' => $version['version_number'], 'platform' => $version['platform']],
                $version
            );
        }
    }
}
