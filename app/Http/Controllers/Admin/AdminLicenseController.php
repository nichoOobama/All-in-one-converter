<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\User;
use Illuminate\Http\Request;

class AdminLicenseController extends Controller
{
    public function index(Request $request)
    {
        $query = License::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('license_key', 'like', "%{$search}%");
        }

        $licenses = $query->latest()->paginate(20);

        return view('admin.licenses.index', compact('licenses'));
    }

    public function show(License $license)
    {
        $license->load('user');

        return view('admin.licenses.show', compact('license'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('admin.licenses.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:single,subscription',
            'expires_at' => 'nullable|date|after:now',
        ]);

        $license = License::create([
            'user_id' => $validated['user_id'],
            'license_key' => License::generateKey(),
            'type' => $validated['type'],
            'status' => 'active',
            'expires_at' => $validated['expires_at'] ?? null,
        ]);

        return redirect()->route('admin.licenses.show', $license->id)
            ->with('success', 'License created: ' . $license->license_key);
    }

    public function destroy(License $license)
    {
        $license->delete();

        return redirect()->route('admin.licenses.index')
            ->with('success', 'License deleted.');
    }
}
