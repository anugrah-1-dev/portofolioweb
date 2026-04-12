@extends('admin.layouts.app')
@section('title', 'Manajemen Pengalaman')

@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-building" style="color:var(--primary2);font-size:0.95rem;"></i> Semua Pengalaman &amp; Organisasi</h2>
        <a href="{{ route('admin.pengalaman.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Pengalaman</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Organisasi / Kegiatan</th>
                    <th style="width:160px;">Peran</th>
                    <th style="width:120px;">Jenis</th>
                    <th style="width:160px;">Periode</th>                    <th style="width:100px;">Sertifikat</th>                    <th style="width:70px;">Urutan</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengalaman as $item)
                <tr>
                    <td>
                        <div class="td-title">{{ $item->nama_organisasi }}</div>
                        @if($item->deskripsi)
                        <div class="td-sub">{{ Str::limit($item->deskripsi, 70) }}</div>
                        @endif
                    </td>
                    <td><span style="font-size:0.9rem;font-weight:600;color:var(--text);">{{ $item->peran }}</span></td>
                    <td>
                        <span class="td-badge">
                            @php
                                $jenis_map = [
                            'organisasi'  => '<i class="fa-solid fa-building-columns"></i> Organisasi',
                                    'kepanitiaan' => '<i class="fa-solid fa-clipboard-list"></i> Kepanitiaan',
                                    'komunitas'   => '<i class="fa-solid fa-people-group"></i> Komunitas',
                                    'magang'      => '<i class="fa-solid fa-briefcase"></i> Magang',
                                    'volunteer'   => '<i class="fa-solid fa-handshake-angle"></i> Volunteer',
                                    'lainnya'     => '<i class="fa-solid fa-ellipsis"></i> Lainnya',
                                ];
                                echo $jenis_map[$item->jenis] ?? $item->jenis;
                            @endphp
                        </span>
                    </td>
                    <td><span style="font-size:0.88rem;font-weight:700;color:var(--muted);">{{ $item->tahun_mulai }} – {{ $item->tahun_selesai ?? 'Sekarang' }}</span></td>
                    <td>
                        @if($item->foto_sertifikat)
                        <a href="{{ \App\Support\MediaUrl::from($item->foto_sertifikat) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ \App\Support\MediaUrl::from($item->foto_sertifikat) }}" alt="Sertifikat"
                                 style="width:64px;height:48px;object-fit:cover;border-radius:8px;border:1.5px solid var(--border);display:block;">
                        </a>
                        @else
                        <span style="font-size:0.78rem;color:var(--faint);">—</span>
                        @endif
                    </td>
                    <td><span style="font-size:0.88rem;color:var(--faint);">{{ $item->urutan }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.pengalaman.edit', $item) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.pengalaman.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus pengalaman ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-building"></i></div>
                            <p>Belum ada data pengalaman. <a href="{{ route('admin.pengalaman.create') }}" style="color:var(--primary);font-weight:700;">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengalaman->hasPages())
    <div style="padding:1.25rem 1.5rem;border-top:1.5px solid var(--border);display:flex;justify-content:flex-end;">
        {{ $pengalaman->links() }}
    </div>
    @endif
</div>
@endsection
