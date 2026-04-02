@extends('admin.layouts.app')
@section('title', 'Manajemen Projek')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-laptop-code" style="color:var(--accent);font-size:0.95rem;"></i> Semua Projek</h2>
        <a href="{{ route('admin.projek.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Projek</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:60px;">Icon</th>
                    <th>Judul &amp; Deskripsi</th>
                    <th>Tags</th>
                    <th style="width:80px;">Warna</th>
                    <th style="width:70px;">Urutan</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projek as $item)
                <tr>
                    <td><span class="td-icon">{{ $item->icon }}</span></td>
                    <td>
                        <div class="td-title">{{ $item->title }}</div>
                        <div class="td-sub">{{ Str::limit($item->description, 70) }}</div>
                    </td>
                    <td>
                        @foreach($item->tags ?? [] as $tag)
                        <span class="td-badge" style="margin-right:3px;">{{ $tag }}</span>
                        @endforeach
                    </td>
                    <td>
                        @php $colors = [1=>'Hijau',2=>'Teal',3=>'Biru']; @endphp
                        <span class="td-badge">{{ $colors[$item->thumb_color] ?? '-' }}</span>
                    </td>
                    <td><span style="font-size:0.88rem;color:var(--faint);">{{ $item->urutan }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.projek.edit', $item) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            <form method="POST" action="{{ route('admin.projek.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus projek ini?')">
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
                            <div class="empty-icon"><i class="fa-solid fa-laptop-code"></i></div>
                            <p>Belum ada data projek. <a href="{{ route('admin.projek.create') }}" style="color:var(--primary);font-weight:700;">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projek->hasPages())
    <div style="padding:1.25rem 1.5rem;border-top:1.5px solid var(--border);display:flex;justify-content:flex-end;">
        {{ $projek->links() }}
    </div>
    @endif
</div>
@endsection
