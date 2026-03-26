<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Projek;
use App\Models\Jurnal;
use App\Models\Profil;
use App\Models\Sosmed;

class PublicController extends Controller
{
    public function index()
    {
        $prestasiAkademik    = Prestasi::where('kategori', 'akademik')->orderBy('urutan')->orderBy('year', 'desc')->get();
        $prestasiNonAkademik = Prestasi::where('kategori', 'non_akademik')->orderBy('urutan')->orderBy('year', 'desc')->get();
        $projek              = Projek::orderBy('urutan')->get();
        $jurnal              = Jurnal::orderBy('urutan')->orderBy('year', 'desc')->get();
        $profil              = Profil::first();
        $sosmed              = Sosmed::orderBy('urutan')->get();

        $totalProjek   = Projek::count();
        $totalJurnal   = Jurnal::count();
        $totalPrestasi = Prestasi::count();

        return view('welcome', compact(
            'prestasiAkademik', 'prestasiNonAkademik', 'projek', 'jurnal',
            'profil', 'sosmed', 'totalProjek', 'totalJurnal', 'totalPrestasi'
        ));
    }
}

