<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    private function getOrCreate(): Profil
    {
        return Profil::firstOrCreate(['id' => 1], [
            'nama'     => 'Anugrah',
            'bio1'     => 'Saya adalah seorang Web Developer yang penuh semangat dalam menciptakan solusi digital yang inovatif dan berdampak.',
            'bio2'     => 'Saya percaya bahwa kode yang baik bukan hanya yang bekerja, tapi juga yang mudah dibaca dan dipelihara.',
            'status'   => 'Tersedia',
            'lokasi'   => 'Indonesia',
            'bahasa'   => 'ID / EN',
            'keahlian' => ['PHP', 'Laravel', 'Vue.js', 'MySQL', 'JavaScript', 'Git'],
        ]);
    }

    public function edit()
    {
        $profil = $this->getOrCreate();
        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama'                 => 'required|string|max:100',
            'bio1'                 => 'nullable|string',
            'bio2'                 => 'nullable|string',
            'status'               => 'nullable|string|max:100',
            'lokasi'               => 'nullable|string|max:100',
            'bahasa'               => 'nullable|string|max:100',
            'keahlian_raw'         => 'nullable|string',
            'foto'                 => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kata_penyemangat_raw' => 'nullable|string',
            'no_whatsapp'          => 'nullable|string|max:20',
        ]);

        $profil = $this->getOrCreate();

        $updateData = [
            'nama'             => $data['nama'],
            'bio1'             => $data['bio1'],
            'bio2'             => $data['bio2'],
            'status'           => $data['status'],
            'lokasi'           => $data['lokasi'],
            'bahasa'           => $data['bahasa'],
            'keahlian'         => array_values(array_filter(array_map('trim', explode(',', $data['keahlian_raw'] ?? '')))),
            'kata_penyemangat' => array_values(array_filter(array_map('trim', explode(',', $data['kata_penyemangat_raw'] ?? '')))),
            'no_whatsapp'      => $data['no_whatsapp'],
        ];

        // Handle foto upload
        if ($request->hasFile('foto')) {
            if ($profil->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $updateData['foto'] = $request->file('foto')->store('profil', 'public');
        }

        // Handle foto removal
        if ($request->boolean('hapus_foto')) {
            if ($profil->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $updateData['foto'] = null;
        }

        $profil->update($updateData);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
