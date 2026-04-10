<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Projek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjekController extends Controller
{
    public function index()
    {
        $projek = Projek::orderBy('urutan')->paginate(10);
        return view('admin.projek.index', compact('projek'));
    }

    public function create()
    {
        return view('admin.projek.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string|max:5000',
            'tags_raw'      => 'nullable|string',
            'thumb_color'   => 'required|integer|in:1,2,3',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri_baru'   => 'nullable|array|max:10',
            'galeri_baru.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'zip_file'      => 'nullable|file|mimes:zip|max:102400',
            'demo_url'      => 'nullable|url|max:255',
            'github_url'    => 'nullable|url|max:255',
            'tipe_akses'    => 'required|in:gratis,berbayar',
            'harga'         => 'nullable|integer|min:1000',
            'urutan'        => 'nullable|integer',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('projek', 'public');
        }

        $galeri = [];
        if ($request->hasFile('galeri_baru')) {
            foreach ($request->file('galeri_baru') as $file) {
                $galeri[] = $file->store('projek', 'public');
            }
        }

        $zipPath = null;
        if ($request->hasFile('zip_file')) {
            $zipPath = $request->file('zip_file')->store('projek-zips', 'local');
        }

        Projek::create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'tags'        => array_values(array_filter(array_map('trim', explode(',', $data['tags_raw'] ?? '')))),
            'thumb_color' => $data['thumb_color'],
            'gambar'      => $gambar,
            'galeri'      => count($galeri) ? $galeri : null,
            'zip_file'    => $zipPath,
            'demo_url'    => $data['demo_url'] ?? null,
            'github_url'  => $data['github_url'] ?? null,
            'tipe_akses'  => $data['tipe_akses'],
            'harga'       => $data['tipe_akses'] === 'berbayar' ? ($data['harga'] ?? null) : null,
            'urutan'      => $data['urutan'] ?? 0,
        ]);

        return redirect()->route('admin.projek.index')->with('success', 'Projek berhasil ditambahkan!');
    }

    public function edit(Projek $projek)
    {
        return view('admin.projek.form', ['item' => $projek]);
    }

    public function update(Request $request, Projek $projek)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string|max:5000',
            'tags_raw'      => 'nullable|string',
            'thumb_color'   => 'required|integer|in:1,2,3',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'galeri_baru'   => 'nullable|array|max:10',
            'galeri_baru.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'hapus_galeri'  => 'nullable|array',
            'zip_file'      => 'nullable|file|mimes:zip|max:102400',
            'hapus_zip'     => 'nullable|boolean',
            'demo_url'      => 'nullable|url|max:255',
            'github_url'    => 'nullable|url|max:255',
            'tipe_akses'    => 'required|in:gratis,berbayar',
            'harga'         => 'nullable|integer|min:1000',
            'urutan'        => 'nullable|integer',
        ]);

        // Handle cover image
        $gambarPath = $projek->gambar;
        if ($request->hasFile('gambar')) {
            if ($projek->gambar) Storage::disk('public')->delete($projek->gambar);
            $gambarPath = $request->file('gambar')->store('projek', 'public');
        } elseif ($request->boolean('hapus_gambar')) {
            if ($projek->gambar) Storage::disk('public')->delete($projek->gambar);
            $gambarPath = null;
        }

        // Handle gallery deletions
        $currentGaleri = $projek->galeri ?? [];
        foreach ($request->input('hapus_galeri', []) as $path) {
            Storage::disk('public')->delete($path);
            $currentGaleri = array_values(array_filter($currentGaleri, fn($g) => $g !== $path));
        }

        // Handle new gallery uploads
        if ($request->hasFile('galeri_baru')) {
            foreach ($request->file('galeri_baru') as $file) {
                $currentGaleri[] = $file->store('projek', 'public');
            }
        }

        // Handle ZIP file
        $zipPath = $projek->zip_file;
        if ($request->hasFile('zip_file')) {
            if ($projek->zip_file) Storage::disk('local')->delete($projek->zip_file);
            $zipPath = $request->file('zip_file')->store('projek-zips', 'local');
        } elseif ($request->boolean('hapus_zip')) {
            if ($projek->zip_file) Storage::disk('local')->delete($projek->zip_file);
            $zipPath = null;
        }

        $projek->update([
            'title'       => $data['title'],
            'description' => $data['description'],
            'tags'        => array_values(array_filter(array_map('trim', explode(',', $data['tags_raw'] ?? '')))),
            'thumb_color' => $data['thumb_color'],
            'gambar'      => $gambarPath,
            'galeri'      => count($currentGaleri) ? array_values($currentGaleri) : null,
            'zip_file'    => $zipPath,
            'demo_url'    => $data['demo_url'] ?? null,
            'github_url'  => $data['github_url'] ?? null,
            'tipe_akses'  => $data['tipe_akses'],
            'harga'       => $data['tipe_akses'] === 'berbayar' ? ($data['harga'] ?? null) : null,
            'urutan'      => $data['urutan'] ?? 0,
        ]);

        return redirect()->route('admin.projek.index')->with('success', 'Projek berhasil diupdate!');
    }

    public function destroy(Projek $projek)
    {
        if ($projek->gambar) Storage::disk('public')->delete($projek->gambar);
        foreach ($projek->galeri ?? [] as $g) {
            Storage::disk('public')->delete($g);
        }
        if ($projek->zip_file) Storage::disk('local')->delete($projek->zip_file);
        $projek->delete();
        return redirect()->route('admin.projek.index')->with('success', 'Projek berhasil dihapus!');
    }
}

