<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiVersionController extends Controller
{
    public function check(Request $request): JsonResponse
    {
        $request->validate([
            'platform' => 'required|in:windows,android',
            'current_version' => 'nullable|string|max:20',
        ]);

        $platform = $request->input('platform');
        $currentVersion = $request->input('current_version');

        $latestVersion = Version::latestForPlatform($platform)->first();

        if (!$latestVersion) {
            return response()->json([
                'success' => true,
                'update_available' => false,
                'message' => 'No version information available.',
            ]);
        }

        $updateAvailable = false;
        $forceUpdate = false;

        if ($currentVersion) {
            $updateAvailable = $latestVersion->getIsNewerThan($currentVersion);

            if ($latestVersion->min_supported_version) {
                $forceUpdate = $latestVersion->force_update &&
                    !$latestVersion->getIsNewerThan($currentVersion) &&
                    version_compare($currentVersion, $latestVersion->min_supported_version, '<');
            }
        } else {
            $updateAvailable = true;
        }

        return response()->json([
            'success' => true,
            'update_available' => $updateAvailable,
            'force_update' => $forceUpdate,
            'latest' => [
                'version' => $latestVersion->version_number,
                'release_date' => $latestVersion->created_at->toDateString(),
                'download_url' => $latestVersion->download_url,
                'changelog' => $latestVersion->changelog ?? [],
                'is_critical' => $latestVersion->is_critical,
                'file_size' => $latestVersion->file_size,
                'file_hash' => $latestVersion->file_hash,
                'min_supported_version' => $latestVersion->min_supported_version,
            ],
            'current_version' => $currentVersion,
        ]);
    }
}
