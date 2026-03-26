<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\Projek;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPrestasi  = Prestasi::count();
        $totalProjek    = Projek::count();
        $recentPrestasi = Prestasi::latest()->take(5)->get();
        $recentProjek   = Projek::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalPrestasi', 'totalProjek', 'recentPrestasi', 'recentProjek'));
    }
}
