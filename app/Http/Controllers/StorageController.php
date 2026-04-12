<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class StorageController extends Controller
{
    // 1×1 transparent GIF — returned when a requested file does not exist.
    // This prevents 404 console errors for records whose files were deleted.
    private const TRANSPARENT_GIF = 'R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';

    public function serve(string $path): Response
    {
        $basePath = realpath(storage_path('app/public'));
        $fullPath = storage_path('app/public/' . $path);
        $realPath = realpath($fullPath);

        // Block path-traversal attempts and missing files
        if (! $basePath || ! $realPath || ! str_starts_with($realPath, $basePath . DIRECTORY_SEPARATOR)) {
            return $this->transparentGif();
        }

        if (! is_file($realPath)) {
            return $this->transparentGif();
        }

        $mime = mime_content_type($realPath) ?: 'application/octet-stream';

        return response()->file($realPath, [
            'Content-Type'  => $mime,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }

    private function transparentGif(): Response
    {
        return response(base64_decode(self::TRANSPARENT_GIF), 200, [
            'Content-Type'  => 'image/gif',
            'Cache-Control' => 'no-store',
        ]);
    }
}
