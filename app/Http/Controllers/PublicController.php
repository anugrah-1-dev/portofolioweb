<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Projek;
use App\Models\Jurnal;
use App\Models\Hki;
use App\Models\Profil;
use App\Models\Sosmed;
use App\Models\Pengalaman;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index()
    {
        $prestasi            = Prestasi::orderBy('urutan')->orderBy('year', 'desc')->get();
        $projek              = Projek::orderBy('urutan')->get();
        $jurnal              = Jurnal::orderBy('urutan')->orderBy('year', 'desc')->get();
        $profil              = Profil::first();
        $sosmed              = Sosmed::orderBy('urutan')->get();
        $pengalaman          = Pengalaman::orderBy('urutan')->orderByDesc('tahun_mulai')->get();

        $totalProjek   = Projek::count();
        $totalJurnal   = Jurnal::count();
        $totalPrestasi = Prestasi::count();

        return view('welcome', compact(
            'prestasi', 'projek', 'jurnal',
            'profil', 'sosmed', 'pengalaman',
            'totalProjek', 'totalJurnal', 'totalPrestasi'
        ));
    }

    public function downloadCv()
    {
        $profil = Profil::first();
        if (!$profil || !$profil->cv_file || !Storage::disk('public')->exists($profil->cv_file)) {
            abort(404, 'CV tidak tersedia.');
        }
        $safeName = preg_replace('/[^a-zA-Z0-9_\- ]/', '', $profil->nama ?? 'Portfolio');
        $extension = pathinfo($profil->cv_file, PATHINFO_EXTENSION) ?: 'pdf';
        return Storage::disk('public')->download($profil->cv_file, 'CV-' . $safeName . '.' . $extension);
    }
}

