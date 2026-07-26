<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversion;
use App\Models\License;
use App\Models\User;
use App\Models\Version;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_conversions' => Conversion::count(),
            'total_licenses' => License::count(),
            'total_versions' => Version::count(),
            'conversions_today' => Conversion::whereDate('created_at', today())->count(),
            'active_licenses' => License::where('status', 'active')->count(),
            'used_licenses' => License::where('status', 'used')->count(),
            'revenue' => License::where('type', 'single')->count() * 9.99
                + License::where('type', 'subscription')->count() * 4.99,
        ];

        $recentConversions = Conversion::with([])
            ->latest()
            ->take(10)
            ->get()
            ->map(fn ($c) => [
                'uuid' => $c->uuid,
                'filename' => $c->source_filename,
                'category' => $c->category,
                'status' => $c->status->value,
                'created_at' => $c->created_at->format('Y-m-d H:i'),
            ]);

        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentConversions', 'recentUsers'));
    }
}
