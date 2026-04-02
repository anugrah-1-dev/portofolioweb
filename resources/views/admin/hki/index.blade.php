@extends('admin.layouts.app')
@section('title', 'Manajemen HKI')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-certificate" style="color:var(--accent);font-size:0.95rem;"></i> Semua HKI</h2>
        <a href="{{ route('admin.hki.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah HKI</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Judul &amp; Penulis</th>
                    <th style="width:130px;">No. Pencatatan</th>
                    <th style="width:120px;">Jenis HKI</th>
                    <th style="width:80px;">Tahun</th>
                    <th style="width:80px;">Link</th>
                    <th style="width:70px;">Urutan</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($hki as $item)
                <tr>
                    <td>
                        <div class="td-title">{{ $item->title }}</div>
                        <div class="td-sub">{{ $item->authors }}</div>
                    </td>
                    <td><span style="font-size:0.82rem;color:var(--muted);">{{ $item->nomor_pencatatan ?? '—' }}</span></td>
                    <td><span class="td-badge">{{ $item->jenis_hki }}</span></td>
                    <td><span style="font-size:0.88rem;font-weight:700;color:var(--muted);">{{ $item->year }}</span></td>
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
                            <a href="{{ route('admin.hki.edit', $item) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.hki.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus data HKI ini?')">
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
                            <div class="empty-icon"><i class="fa-solid fa-certificate"></i></div>
                            <p>Belum ada data HKI. <a href="{{ route('admin.hki.create') }}" style="color:var(--primary);font-weight:700;">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($hki->hasPages())
    <div style="padding:1.25rem 1.5rem;border-top:1.5px solid var(--border);display:flex;justify-content:flex-end;">
        {{ $hki->links() }}
    </div>
    @endif
</div>
@endsection
