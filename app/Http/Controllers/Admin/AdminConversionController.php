<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversion;
use Illuminate\Http\Request;

class AdminConversionController extends Controller
{
    public function index(Request $request)
    {
        $query = Conversion::query();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('source_filename', 'like', "%{$search}%");
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->input('date_to'));
        }

        $conversions = $query->latest()->paginate(20);

        return view('admin.conversions.index', compact('conversions'));
    }

    public function show(Conversion $conversion)
    {
        return view('admin.conversions.show', ['conversion' => $conversion]);
    }

    public function destroy(Conversion $conversion)
    {
        if ($conversion->output_path) {
            $fullPath = storage_path('app/' . $conversion->output_path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }

        $conversion->delete();

        return redirect()->route('admin.conversions.index')
            ->with('success', 'Conversion deleted.');
    }
}
