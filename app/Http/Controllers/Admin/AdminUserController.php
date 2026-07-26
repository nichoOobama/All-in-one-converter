<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['licenses', 'conversions' => function ($q) {
            $q->latest()->take(20);
        }]);

        $stats = [
            'total_conversions' => $user->conversions()->count(),
            'total_licenses' => $user->licenses()->count(),
            'active_licenses' => $user->licenses()->where('status', 'active')->count(),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    public function updateRole(User $user)
    {
        $user->update([
            'role' => $user->role === 'admin' ? 'user' : 'admin',
        ]);

        return back()->with('success', "User role updated to {$user->role}.");
    }

    public function destroy(User $user)
    {
        $user->licenses()->delete();
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
