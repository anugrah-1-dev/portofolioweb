@extends('admin.layouts.app')
@section('title', 'Manajemen Lisensi & Sertifikasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-certificate" style="color:var(--accent);font-size:0.95rem;"></i> Semua Lisensi &amp; Sertifikasi</h2>
        <a href="{{ route('admin.jurnal.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Lisensi</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:60px;">Icon</th>
                    <th>Judul &amp; Penulis</th>
                    <th>Nama Jurnal</th>
                    <th style="width:90px;">Tahun</th>
                    <th style="width:110px;">Indeks</th>
                    <th style="width:80px;">Link</th>
                    <th style="width:70px;">Urutan</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jurnal as $item)
                <tr>
                    <td><span class="td-icon">{{ $item->icon }}</span></td>
                    <td>
                        <div class="td-title">{{ $item->title }}</div>
                        <div class="td-sub">{{ $item->authors }}</div>
                    </td>
                    <td><div class="td-sub" style="color:var(--text)">{{ $item->journal_name }}</div></td>
                    <td><span style="font-size:0.88rem;font-weight:700;color:var(--muted);">{{ $item->year }}</span></td>
                    <td><span class="td-badge">{{ $item->indexed_by }}</span></td>
                    <td>
                        @if($item->url)
                        <a href="{{ $item->url }}" target="_blank" style="color:var(--accent);font-size:0.82rem;font-weight:700;text-decoration:none;display:inline-flex;align-items:center;gap:0.3rem;"><i class="fa-solid fa-arrow-up-right-from-square"></i> Buka</a>
                        @else
                        <span style="color:var(--faint);font-size:0.82rem;">—</span>
                        @endif
                    </td>
                    <td><span style="font-size:0.88rem;color:var(--faint);">{{ $item->urutan }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.jurnal.edit', $item) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.jurnal.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus jurnal ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-file-lines"></i></div>
                            <p>Belum ada data jurnal. <a href="{{ route('admin.jurnal.create') }}" style="color:var(--primary);font-weight:700;">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($jurnal->hasPages())
    <div style="padding:1.25rem 1.5rem;border-top:1.5px solid var(--border);display:flex;justify-content:flex-end;">
        {{ $jurnal->links() }}
    </div>
    @endif
</div>
@endsection
