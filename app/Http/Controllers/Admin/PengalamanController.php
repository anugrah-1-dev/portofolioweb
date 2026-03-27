<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengalaman;
use Illuminate\Http\Request;

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
            'tahun_mulai'     => 'required|string|max:20',
            'tahun_selesai'   => 'nullable|string|max:20',
            'jenis'           => 'required|in:organisasi,kepanitiaan,komunitas,magang,volunteer,lainnya',
            'urutan'          => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;
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
            'tahun_mulai'     => 'required|string|max:20',
            'tahun_selesai'   => 'nullable|string|max:20',
            'jenis'           => 'required|in:organisasi,kepanitiaan,komunitas,magang,volunteer,lainnya',
            'urutan'          => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;
        $pengalaman->update($data);

        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil diupdate!');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        $pengalaman->delete();
        return redirect()->route('admin.pengalaman.index')->with('success', 'Pengalaman berhasil dihapus!');
    }
}
