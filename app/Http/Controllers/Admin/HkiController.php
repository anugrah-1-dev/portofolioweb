<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hki;
use Illuminate\Http\Request;

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
            'url'              => 'nullable|url|max:500',
            'description'      => 'nullable|string',
            'urutan'           => 'nullable|integer',
        ]);

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
            'url'              => 'nullable|url|max:500',
            'description'      => 'nullable|string',
            'urutan'           => 'nullable|integer',
        ]);

        $hki->update($data);

        return redirect()->route('admin.hki.index')
            ->with('success', 'Data HKI berhasil diperbarui.');
    }

    public function destroy(Hki $hki)
    {
        $hki->delete();

        return redirect()->route('admin.hki.index')
            ->with('success', 'Data HKI berhasil dihapus.');
    }
}
