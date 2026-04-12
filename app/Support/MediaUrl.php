<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaUrl
{
    public static function from(?string $path): string
    {
        $rawPath = trim((string) $path);

        if ($rawPath === '') {
            return '';
        }

        if (Str::startsWith($rawPath, ['http://', 'https://', '//'])) {
            $normalizedPath = static::path($rawPath);

            if ($normalizedPath === $rawPath) {
                return $rawPath;
            }

            return Storage::disk('public')->url($normalizedPath);
        }

        return Storage::disk('public')->url(static::path($rawPath));
    }

    public static function path(?string $path): string
    {
        $rawPath = trim((string) $path);

        if ($rawPath === '') {
            return '';
        }

        if (Str::startsWith($rawPath, ['http://', 'https://', '//'])) {
            $parsedPath = parse_url($rawPath, PHP_URL_PATH);

            if (! is_string($parsedPath) || $parsedPath === '') {
                return $rawPath;
            }

            $normalizedPath = static::stripKnownPrefix(ltrim($parsedPath, '/'));

            return $normalizedPath !== ltrim($parsedPath, '/')
                ? $normalizedPath
                : $rawPath;
        }

        return static::stripKnownPrefix(ltrim($rawPath, '/'));
    }

    public static function exists(?string $path): bool
    {
        $normalizedPath = static::path($path);

        if ($normalizedPath === '' || Str::startsWith($normalizedPath, ['http://', 'https://', '//'])) {
            return false;
        }

        return Storage::disk('public')->exists($normalizedPath);
    }

    private static function stripKnownPrefix(string $path): string
    {
        foreach (['storage/', 'media/'] as $prefix) {
            if (Str::startsWith($path, $prefix)) {
                return substr($path, strlen($prefix));
            }
        }

        return $path;
    }
}
