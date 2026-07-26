<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function index()
    {
        $licenses = auth()->user()->licenses()->latest()->get();

        return view('licenses.index', compact('licenses'));
    }

    public function show(License $license)
    {
        if ($license->user_id !== auth()->id()) {
            abort(403);
        }

        return view('licenses.show', compact('license'));
    }

    public function pricing()
    {
        return view('pricing.index');
    }

    public function checkout(string $plan)
    {
        if (!in_array($plan, ['single', 'subscription'])) {
            abort(404);
        }

        return view('checkout.index', ['plan' => $plan]);
    }

    public function processCheckout(Request $request, string $plan)
    {
        if (!in_array($plan, ['single', 'subscription'])) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $expiresAt = $plan === 'subscription'
            ? now()->addMonth()
            : null;

        $license = License::create([
            'user_id' => auth()->id(),
            'license_key' => License::generateKey(),
            'type' => $plan,
            'status' => 'active',
            'expires_at' => $expiresAt,
        ]);

        return redirect()
            ->route('licenses.show', $license->license_key)
            ->with('success', 'License purchased successfully! Copy your license key below.');
    }
}
