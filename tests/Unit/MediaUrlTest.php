<?php

namespace Tests\Unit;

use App\Support\MediaUrl;
use Tests\TestCase;

class MediaUrlTest extends TestCase
{
    public function test_it_generates_a_public_media_url_from_a_relative_path(): void
    {
        $this->assertStringEndsWith('/media/profil/test.jpg', MediaUrl::from('profil/test.jpg'));
    }

    public function test_it_normalizes_legacy_storage_paths(): void
    {
        $this->assertSame('profil/test.jpg', MediaUrl::path('/storage/profil/test.jpg'));
        $this->assertStringEndsWith('/media/profil/test.jpg', MediaUrl::from('/storage/profil/test.jpg'));
    }

    public function test_it_normalizes_full_legacy_storage_urls(): void
    {
        $legacyUrl = 'https://alifiashofanabilah.my.id/storage/profil/test.jpg';

        $this->assertSame('profil/test.jpg', MediaUrl::path($legacyUrl));
        $this->assertStringEndsWith('/media/profil/test.jpg', MediaUrl::from($legacyUrl));
    }
}
