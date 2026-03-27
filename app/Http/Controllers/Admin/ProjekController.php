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
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'tags_raw'    => 'nullable|string',
            'thumb_color' => 'required|integer|in:1,2,3',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'demo_url'    => 'nullable|url|max:255',
            'github_url'  => 'nullable|url|max:255',
            'urutan'      => 'nullable|integer',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('projek', 'public');
        }

        Projek::create([
            'title'       => $data['title'],
            'description' => $data['description'],
            'tags'        => array_values(array_filter(array_map('trim', explode(',', $data['tags_raw'] ?? '')))),
            'thumb_color' => $data['thumb_color'],
            'gambar'      => $gambar,
            'demo_url'    => $data['demo_url'] ?? null,
            'github_url'  => $data['github_url'] ?? null,
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'tags_raw'    => 'nullable|string',
            'thumb_color' => 'required|integer|in:1,2,3',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'demo_url'    => 'nullable|url|max:255',
            'github_url'  => 'nullable|url|max:255',
            'urutan'      => 'nullable|integer',
        ]);

        $gambarPath = $projek->gambar;

        if ($request->hasFile('gambar')) {
            if ($projek->gambar) Storage::disk('public')->delete($projek->gambar);
            $gambarPath = $request->file('gambar')->store('projek', 'public');
        } elseif ($request->boolean('hapus_gambar')) {
            if ($projek->gambar) Storage::disk('public')->delete($projek->gambar);
            $gambarPath = null;
        }

        $projek->update([
            'title'       => $data['title'],
            'description' => $data['description'],
            'tags'        => array_values(array_filter(array_map('trim', explode(',', $data['tags_raw'] ?? '')))),
            'thumb_color' => $data['thumb_color'],
            'gambar'      => $gambarPath,
            'demo_url'    => $data['demo_url'] ?? null,
            'github_url'  => $data['github_url'] ?? null,
            'urutan'      => $data['urutan'] ?? 0,
        ]);

        return redirect()->route('admin.projek.index')->with('success', 'Projek berhasil diupdate!');
    }

    public function destroy(Projek $projek)
    {
        if ($projek->gambar) Storage::disk('public')->delete($projek->gambar);
        $projek->delete();
        return redirect()->route('admin.projek.index')->with('success', 'Projek berhasil dihapus!');
    }
}

