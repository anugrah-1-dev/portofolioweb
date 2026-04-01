<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class StorageController extends Controller
{
    public function serve(string $path): Response
    {
        $fullPath = storage_path('app/public/' . $path);

        if (! file_exists($fullPath) || ! is_file($fullPath)) {
            abort(404);
        }

        $mime = mime_content_type($fullPath) ?: 'application/octet-stream';

        return response()->file($fullPath, [
            'Content-Type'  => $mime,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}
