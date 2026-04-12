<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class StorageController extends Controller
{
    // 1×1 transparent GIF — returned when a requested file does not exist.
    // This prevents 404 console errors for records whose files were deleted.
    private const TRANSPARENT_GIF = 'R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

    public function serve(string $path): Response
    {
        try {
            $basePath = realpath(storage_path('app/public'));
            $fullPath = storage_path('app/public/' . ltrim($path, '/'));
            $realPath = realpath($fullPath);

            // Block path-traversal attempts, missing files, and unreadable files.
            if (! $basePath || ! $realPath || ! str_starts_with($realPath, $basePath . DIRECTORY_SEPARATOR)) {
                return $this->transparentGif();
            }

            if (! is_file($realPath) || ! is_readable($realPath)) {
                return $this->transparentGif();
            }

            return response()->file($realPath, [
                'Content-Type'  => $this->detectMimeType($realPath),
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        } catch (Throwable $e) {
            Log::warning('Failed to serve public media file.', [
                'path' => $path,
                'message' => $e->getMessage(),
            ]);

            return $this->transparentGif();
        }
    }

    private function transparentGif(): Response
    {
        return response(base64_decode(self::TRANSPARENT_GIF), 200, [
            'Content-Type'  => 'image/gif',
            'Cache-Control' => 'no-store',
        ]);
    }

    private function detectMimeType(string $realPath): string
    {
        try {
            $mime = @mime_content_type($realPath);

            if (is_string($mime) && $mime !== '') {
                return $mime;
            }
        } catch (Throwable) {
            // Fall back to the extension mapping below.
        }

        return match (strtolower(pathinfo($realPath, PATHINFO_EXTENSION))) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            'pdf' => 'application/pdf',
            default => 'application/octet-stream',
        };
    }
}
