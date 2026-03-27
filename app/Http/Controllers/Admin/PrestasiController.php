<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::orderBy('urutan')->orderBy('year', 'desc')->paginate(10);
        return view('admin.prestasi.index', compact('prestasi'));
    }

    public function create()
    {
        return view('admin.prestasi.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon'        => 'required|string|max:20',
            'year'        => 'required|string|size:4',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'badge'       => 'required|string|max:100',
            'kategori'    => 'required|in:akademik,non_akademik',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'      => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        }

        $data['urutan'] = $data['urutan'] ?? 0;

        Prestasi::create($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil ditambahkan!');
    }

    public function edit(Prestasi $prestasi)
    {
        return view('admin.prestasi.form', ['item' => $prestasi]);
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $request->validate([
            'icon'        => 'required|string|max:20',
            'year'        => 'required|string|size:4',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'badge'       => 'required|string|max:100',
            'kategori'    => 'required|in:akademik,non_akademik',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'hapus_foto'  => 'nullable|boolean',
            'urutan'      => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            if ($prestasi->foto) Storage::disk('public')->delete($prestasi->foto);
            $data['foto'] = $request->file('foto')->store('prestasi', 'public');
        } elseif ($request->boolean('hapus_foto')) {
            if ($prestasi->foto) Storage::disk('public')->delete($prestasi->foto);
            $data['foto'] = null;
        } else {
            unset($data['foto']);
        }

        unset($data['hapus_foto']);
        $data['urutan'] = $data['urutan'] ?? 0;
        $prestasi->update($data);

        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil diupdate!');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->foto) Storage::disk('public')->delete($prestasi->foto);
        $prestasi->delete();
        return redirect()->route('admin.prestasi.index')->with('success', 'Prestasi berhasil dihapus!');
    }
}

