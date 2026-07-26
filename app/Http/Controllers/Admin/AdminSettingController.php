<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = $this->getSettings();

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settingsPath = config_path('converter.php');

        $config = include $settingsPath;

        if ($request->has('limits.per_user_daily')) {
            $config['limits']['per_user_daily'] = (int) $request->input('limits.per_user_daily');
        }

        if ($request->has('limits.max_file_size_mb')) {
            $config['limits']['max_file_size_mb'] = (int) $request->input('limits.max_file_size_mb');
        }

        if ($request->has('temp_lifetime_hours')) {
            $config['temp_lifetime_hours'] = (int) $request->input('temp_lifetime_hours');
        }

        if ($request->has('drivers.ffmpeg')) {
            $config['drivers']['ffmpeg'] = $request->input('drivers.ffmpeg');
        }

        if ($request->has('drivers.libreoffice')) {
            $config['drivers']['libreoffice'] = $request->input('drivers.libreoffice');
        }

        $exported = var_export($config, true);
        $content = "<?php\n\nreturn {$exported};\n";

        File::put($settingsPath, $content);

        return back()->with('success', 'Settings updated successfully.');
    }

    private function getSettings(): array
    {
        return config('converter');
    }
}
