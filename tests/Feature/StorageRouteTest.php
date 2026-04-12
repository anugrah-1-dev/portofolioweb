<?php

namespace Tests\Feature;

use App\Http\Controllers\StorageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StorageRouteTest extends TestCase
{
    public function test_storage_path_uses_the_custom_storage_controller(): void
    {
        $route = app('router')->getRoutes()->match(
            Request::create('/storage/profil/test.jpg', 'GET')
        );

        $this->assertSame(StorageController::class.'@serve', $route->getActionName());
    }

    public function test_missing_storage_file_returns_a_transparent_gif(): void
    {
        $response = $this->get('/storage/profil/does-not-exist.jpg');

        $response->assertOk();
        $response->assertHeader('Content-Type', 'image/gif');
    }

    public function test_existing_media_file_is_served_without_error(): void
    {
        Storage::disk('public')->put(
            'prestasi/test-media.gif',
            base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
        );

        try {
            $response = $this->get('/media/prestasi/test-media.gif');

            $response->assertOk();
            $response->assertHeader('Content-Type', 'image/gif');
        } finally {
            Storage::disk('public')->delete('prestasi/test-media.gif');
        }
    }
}
