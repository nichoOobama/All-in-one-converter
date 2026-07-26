<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiLicenseController extends Controller
{
    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'license_key' => 'required|string',
        ]);

        $license = License::where('license_key', $request->input('license_key'))->first();

        if (!$license) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'License key not found.',
            ], 404);
        }

        if ($license->isUsed()) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'License has already been used.',
            ], 422);
        }

        if ($license->isExpired()) {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'License has expired.',
            ], 422);
        }

        if ($license->status !== 'active') {
            return response()->json([
                'success' => false,
                'valid' => false,
                'message' => 'License is not active.',
            ], 422);
        }

        $license->update([
            'status' => 'used',
            'used_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'valid' => true,
            'message' => 'License activated successfully.',
            'license' => [
                'type' => $license->type,
                'activated_at' => $license->fresh()->used_at->toIso8601String(),
            ],
        ]);
    }
}
