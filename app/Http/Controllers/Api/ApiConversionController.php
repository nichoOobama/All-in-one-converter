<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ConversionService;
use App\Services\TemporaryFileManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiConversionController extends Controller
{
    public function __construct(
        private ConversionService $conversionService,
    ) {}

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|file|max:204800',
            'target_format' => 'required|string|max:10',
        ]);

        try {
            $conversion = $this->conversionService->convert(
                $request->file('file'),
                $request->input('target_format'),
                $request->only(['quality', 'bitrate', 'codec', 'crf', 'preset']),
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'uuid' => $conversion->uuid,
                    'status' => $conversion->status->value,
                    'source_filename' => $conversion->source_filename,
                    'target_extension' => $conversion->target_extension,
                    'category' => $conversion->category,
                    'status_url' => route('api.convert.status', $conversion->uuid),
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 422);
        }
    }

    public function status(string $uuid): JsonResponse
    {
        $conversion = $this->conversionService->getStatus($uuid);

        if (!$conversion) {
            return response()->json(['error' => 'Conversion not found'], 404);
        }

        $data = [
            'uuid' => $conversion->uuid,
            'status' => $conversion->status->value,
            'source_filename' => $conversion->source_filename,
            'target_extension' => $conversion->target_extension,
            'category' => $conversion->category,
            'source_size' => $conversion->source_size,
            'output_size' => $conversion->output_size,
            'duration_ms' => $conversion->duration_ms,
            'error_message' => $conversion->error_message,
            'created_at' => $conversion->created_at->toIso8601String(),
        ];

        if ($conversion->isCompleted()) {
            $data['download_url'] = route('api.convert.download', $conversion->uuid);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    public function download(string $uuid): JsonResponse
    {
        $conversion = \App\Models\Conversion::where('uuid', $uuid)->first();

        if (!$conversion) {
            return response()->json(['error' => 'Conversion not found'], 404);
        }

        if (!$conversion->isCompleted()) {
            return response()->json(['error' => 'Conversion not completed'], 400);
        }

        $fullPath = storage_path('app/' . $conversion->output_path);

        if (!file_exists($fullPath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $filename = $conversion->source_filename . '.converted.' . $conversion->target_extension;

        return response()->download($fullPath, $filename);
    }
}
