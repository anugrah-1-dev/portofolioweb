<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosmed;
use Illuminate\Http\Request;

class SosmedController extends Controller
{
    public function index()
    {
        $sosmed = Sosmed::orderBy('urutan')->get();
        return view('admin.sosmed.index', compact('sosmed'));
    }

    public function create()
    {
        return view('admin.sosmed.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:50',
            'label'    => 'required|string|max:100',
            'url'      => 'required|url|max:255',
            'urutan'   => 'nullable|integer',
        ]);
        $data['urutan'] = $data['urutan'] ?? 0;
        Sosmed::create($data);
        return redirect()->route('admin.sosmed.index')->with('success', 'Sosial media berhasil ditambahkan!');
    }

    public function edit(Sosmed $sosmed)
    {
        return view('admin.sosmed.form', ['item' => $sosmed]);
    }

    public function update(Request $request, Sosmed $sosmed)
    {
        $data = $request->validate([
            'platform' => 'required|string|max:50',
            'label'    => 'required|string|max:100',
            'url'      => 'required|url|max:255',
            'urutan'   => 'nullable|integer',
        ]);
        $data['urutan'] = $data['urutan'] ?? 0;
        $sosmed->update($data);
        return redirect()->route('admin.sosmed.index')->with('success', 'Sosial media berhasil diupdate!');
    }

    public function destroy(Sosmed $sosmed)
    {
        $sosmed->delete();
        return redirect()->route('admin.sosmed.index')->with('success', 'Sosial media berhasil dihapus!');
    }
}
