@extends('admin.layouts.app')
@section('title', 'Manajemen Prestasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-trophy" style="color:var(--gold);font-size:0.95rem;"></i> Semua Prestasi</h2>
        <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Prestasi</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:60px;">Icon</th>
                    <th>Judul &amp; Deskripsi</th>
                    <th style="width:90px;">Tahun</th>
                    <th style="width:130px;">Jenis</th>
                    <th style="width:120px;">Badge</th>
                    <th style="width:70px;">Urutan</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasi as $item)
                <tr>
                    <td><span class="td-icon">{{ $item->icon }}</span></td>
                    <td>
                        <div class="td-title">{{ $item->title }}</div>
                        <div class="td-sub">{{ Str::limit($item->description, 70) }}</div>
                    </td>
                    <td><span style="font-size:0.88rem;font-weight:700;color:var(--muted);">{{ $item->year }}</span></td>
                    <td><span class="td-badge" style="{{ $item->kategori === 'akademik' ? 'background:rgba(13,148,136,0.1);color:var(--accent);border-color:rgba(13,148,136,0.3)' : '' }}">
                        {{ $item->kategori === 'akademik' ? '<i class="fa-solid fa-graduation-cap"></i> Akademik' : '<i class="fa-solid fa-trophy"></i> Non-Akademik' }}
                    </span></td>
                    <td><span class="td-badge">{{ $item->badge }}</span></td>
                    <td><span style="font-size:0.88rem;color:var(--faint);">{{ $item->urutan }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.prestasi.edit', $item) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.prestasi.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus prestasi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-trophy"></i></div>
                            <p>Belum ada data prestasi. <a href="{{ route('admin.prestasi.create') }}" style="color:var(--primary);font-weight:700;">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($prestasi->hasPages())
    <div style="padding:1.25rem 1.5rem;border-top:1.5px solid var(--border);display:flex;justify-content:flex-end;">
        {{ $prestasi->links() }}
    </div>
    @endif
</div>
@endsection
