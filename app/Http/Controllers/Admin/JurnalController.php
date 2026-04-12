<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnal = Jurnal::orderBy('urutan')->orderBy('year', 'desc')->paginate(10);
        return view('admin.jurnal.index', compact('jurnal'));
    }

    public function create()
    {
        return view('admin.jurnal.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'authors'      => 'nullable|string|max:255',
            'journal_name' => 'required|string|max:255',
            'year'         => 'required|string|size:4',
            'indexed_by'   => 'nullable|string|max:100',
            'file_sertifikat' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'description'  => 'nullable|string|max:5000',
            'urutan'       => 'nullable|integer',
        ]);

        $data['icon']   = '📄';
        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('file_sertifikat')) {
            $data['file_sertifikat'] = $request->file('file_sertifikat')->store('jurnal', 'public');
        }

        Jurnal::create($data);

        return redirect()->route('admin.jurnal.index')->with('success', 'Lisensi berhasil ditambahkan!');
    }

    public function edit(Jurnal $jurnal)
    {
        return view('admin.jurnal.form', ['item' => $jurnal]);
    }

    public function update(Request $request, Jurnal $jurnal)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'authors'      => 'nullable|string|max:255',
            'journal_name' => 'required|string|max:255',
            'year'         => 'required|string|size:4',
            'indexed_by'   => 'nullable|string|max:100',
            'file_sertifikat' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:10240',
            'hapus_file'   => 'nullable|boolean',
            'description'  => 'nullable|string|max:5000',
            'urutan'       => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->boolean('hapus_file') && $jurnal->file_sertifikat) {
            Storage::disk('public')->delete($jurnal->file_sertifikat);
            $data['file_sertifikat'] = null;
        } elseif ($request->hasFile('file_sertifikat')) {
            if ($jurnal->file_sertifikat) {
                Storage::disk('public')->delete($jurnal->file_sertifikat);
            }
            $data['file_sertifikat'] = $request->file('file_sertifikat')->store('jurnal', 'public');
        } else {
            unset($data['file_sertifikat']);
        }

        unset($data['hapus_file']);
        $jurnal->update($data);

        return redirect()->route('admin.jurnal.index')->with('success', 'Lisensi berhasil diupdate!');
    }

    public function destroy(Jurnal $jurnal)
    {
        if ($jurnal->file_sertifikat) {
            Storage::disk('public')->delete($jurnal->file_sertifikat);
        }
        $jurnal->delete();
        return redirect()->route('admin.jurnal.index')->with('success', 'Lisensi berhasil dihapus!');
    }
}