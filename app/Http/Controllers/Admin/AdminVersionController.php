<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\Request;

class AdminVersionController extends Controller
{
    public function index()
    {
        $versions = Version::orderBy('platform')->orderByDesc('created_at')->get();

        return view('admin.versions.index', compact('versions'));
    }

    public function create()
    {
        return view('admin.versions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'version_number' => 'required|string|max:20',
            'platform' => 'required|in:windows,android',
            'download_url' => 'required|string|max:255',
            'file_size' => 'nullable|integer|min:0',
            'changelog' => 'nullable|string',
            'is_critical' => 'boolean',
            'force_update' => 'boolean',
            'min_supported_version' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $validated['changelog'] = $validated['changelog']
            ? array_map('trim', explode("\n", $validated['changelog']))
            : [];

        $validated['is_critical'] = $request->boolean('is_critical');
        $validated['force_update'] = $request->boolean('force_update');
        $validated['is_active'] = $request->has('is_active');

        Version::create($validated);

        return redirect()->route('admin.versions.index')
            ->with('success', 'Version created successfully.');
    }

    public function edit(Version $version)
    {
        return view('admin.versions.edit', compact('version'));
    }

    public function update(Request $request, Version $version)
    {
        $validated = $request->validate([
            'version_number' => 'required|string|max:20',
            'platform' => 'required|in:windows,android',
            'download_url' => 'required|string|max:255',
            'file_size' => 'nullable|integer|min:0',
            'changelog' => 'nullable|string',
            'is_critical' => 'boolean',
            'force_update' => 'boolean',
            'min_supported_version' => 'nullable|string|max:20',
            'is_active' => 'boolean',
        ]);

        $validated['changelog'] = $validated['changelog']
            ? array_map('trim', explode("\n", $validated['changelog']))
            : [];

        $validated['is_critical'] = $request->boolean('is_critical');
        $validated['force_update'] = $request->boolean('force_update');
        $validated['is_active'] = $request->has('is_active');

        $version->update($validated);

        return redirect()->route('admin.versions.index')
            ->with('success', 'Version updated successfully.');
    }

    public function destroy(Version $version)
    {
        $version->delete();

        return redirect()->route('admin.versions.index')
            ->with('success', 'Version deleted.');
    }
}
