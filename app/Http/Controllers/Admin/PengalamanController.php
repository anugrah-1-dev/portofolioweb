<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengalaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengalamanController extends Controller
{
    public function index()
    {
        $pengalaman = Pengalaman::orderBy('urutan')->orderByDesc('tahun_mulai')->paginate(15);
        return view('admin.pengalaman.index', compact('pengalaman'));
    }

    public function create()
    {
        return view('admin.pengalaman.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_organisasi' => 'required|string|max:200',
            'peran'           => 'required|string|max:200',
            'deskripsi'       => 'nullable|string|max:5000',
            'foto_sertifikat' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'tahun_mulai'     => 'required|string|max:20',
            'tahun_selesai'   => 'nullable|string|max:20',
            'jenis'           => 'required|in:organisasi,kepanitiaan,komunitas,magang,volunteer,work,lainnya',
            'urutan'          => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('foto_sertifikat')) {
            $data['foto_sertifikat'] = $request->file('foto_sertifikat')->store('pengalaman', 'public');
        }

        Pengalaman::create($data);

        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    public function edit(Pengalaman $pengalaman)
    {
        return view('admin.pengalaman.form', ['item' => $pengalaman]);
    }

    public function update(Request $request, Pengalaman $pengalaman)
    {
        $data = $request->validate([
            'nama_organisasi' => 'required|string|max:200',
            'peran'           => 'required|string|max:200',
            'deskripsi'       => 'nullable|string|max:5000',
            'foto_sertifikat' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hapus_sertifikat'=> 'nullable|boolean',
            'tahun_mulai'     => 'required|string|max:20',
            'tahun_selesai'   => 'nullable|string|max:20',
            'jenis'           => 'required|in:organisasi,kepanitiaan,komunitas,magang,volunteer,work,lainnya',
            'urutan'          => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->boolean('hapus_sertifikat') && $pengalaman->foto_sertifikat) {
            Storage::disk('public')->delete($pengalaman->foto_sertifikat);
            $data['foto_sertifikat'] = null;
        }

        if ($request->hasFile('foto_sertifikat')) {
            if ($pengalaman->foto_sertifikat) {
                Storage::disk('public')->delete($pengalaman->foto_sertifikat);
            }
            $data['foto_sertifikat'] = $request->file('foto_sertifikat')->store('pengalaman', 'public');
        }

        $pengalaman->update($data);

        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil diupdate!');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        if ($pengalaman->foto_sertifikat) {
            Storage::disk('public')->delete($pengalaman->foto_sertifikat);
        }
        $pengalaman->delete();
        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil dihapus!');
    }
}
