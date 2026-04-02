<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HkiController extends Controller
{
    public function index()
    {
        $hki = Hki::orderBy('urutan')->orderBy('year', 'desc')->paginate(10);
        return view('admin.hki.index', compact('hki'));
    }

    public function create()
    {
        return view('admin.hki.form', ['hki' => new Hki(), 'action' => 'create']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_pencatatan' => 'nullable|string|max:100',
            'title'            => 'required|string|max:255',
            'authors'          => 'required|string|max:255',
            'jenis_hki'        => 'required|string|max:100',
            'year'             => 'required|digits:4|integer',
            'sertifikat_file'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'description'      => 'nullable|string',
            'urutan'           => 'nullable|integer',
        ]);

        if ($request->hasFile('sertifikat_file')) {
            $data['sertifikat_file'] = $request->file('sertifikat_file')
                ->store('hki-sertifikat', 'public');
        } else {
            unset($data['sertifikat_file']);
        }

        Hki::create($data);

        return redirect()->route('admin.hki.index')
            ->with('success', 'Data HKI berhasil ditambahkan.');
    }

    public function edit(Hki $hki)
    {
        return view('admin.hki.form', ['hki' => $hki, 'action' => 'edit']);
    }

    public function update(Request $request, Hki $hki)
    {
        $data = $request->validate([
            'nomor_pencatatan' => 'nullable|string|max:100',
            'title'            => 'required|string|max:255',
            'authors'          => 'required|string|max:255',
            'jenis_hki'        => 'required|string|max:100',
            'year'             => 'required|digits:4|integer',
            'sertifikat_file'  => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:5120',
            'description'      => 'nullable|string',
            'urutan'           => 'nullable|integer',
        ]);

        // Upload file baru
        if ($request->hasFile('sertifikat_file')) {
            if ($hki->sertifikat_file) {
                Storage::disk('public')->delete($hki->sertifikat_file);
            }
            $data['sertifikat_file'] = $request->file('sertifikat_file')
                ->store('hki-sertifikat', 'public');
        } else {
            unset($data['sertifikat_file']);
        }

        // Hapus file
        if ($request->boolean('hapus_sertifikat')) {
            if ($hki->sertifikat_file) {
                Storage::disk('public')->delete($hki->sertifikat_file);
            }
            $data['sertifikat_file'] = null;
        }

        $hki->update($data);

        return redirect()->route('admin.hki.index')
            ->with('success', 'Data HKI berhasil diperbarui.');
    }

    public function destroy(Hki $hki)
    {
        if ($hki->sertifikat_file) {
            Storage::disk('public')->delete($hki->sertifikat_file);
        }
        $hki->delete();

        return redirect()->route('admin.hki.index')
            ->with('success', 'Data HKI berhasil dihapus.');
    }
}
