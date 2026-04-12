<?php

namespace Tests\Feature;

use App\Http\Controllers\StorageController;
use Illuminate\Http\Request;
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
}
