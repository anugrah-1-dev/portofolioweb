<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use Illuminate\Http\Request;

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
            'icon'         => 'required|string|max:20',
            'title'        => 'required|string|max:255',
            'authors'      => 'required|string|max:255',
            'journal_name' => 'required|string|max:255',
            'year'         => 'required|string|size:4',
            'indexed_by'   => 'required|string|max:100',
            'url'          => 'nullable|url|max:500',
            'description'  => 'nullable|string|max:5000',
            'urutan'       => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;
        Jurnal::create($data);

        return redirect()->route('admin.jurnal.index')->with('success', 'Jurnal berhasil ditambahkan!');
    }

    public function edit(Jurnal $jurnal)
    {
        return view('admin.jurnal.form', ['item' => $jurnal]);
    }

    public function update(Request $request, Jurnal $jurnal)
    {
        $data = $request->validate([
            'icon'         => 'required|string|max:20',
            'title'        => 'required|string|max:255',
            'authors'      => 'required|string|max:255',
            'journal_name' => 'required|string|max:255',
            'year'         => 'required|string|size:4',
            'indexed_by'   => 'required|string|max:100',
            'url'          => 'nullable|url|max:500',
            'description'  => 'nullable|string|max:5000',
            'urutan'       => 'nullable|integer',
        ]);

        $data['urutan'] = $data['urutan'] ?? 0;
        $jurnal->update($data);

        return redirect()->route('admin.jurnal.index')->with('success', 'Jurnal berhasil diupdate!');
    }

    public function destroy(Jurnal $jurnal)
    {
        $jurnal->delete();
        return redirect()->route('admin.jurnal.index')->with('success', 'Jurnal berhasil dihapus!');
    }
}
