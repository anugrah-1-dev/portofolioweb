@extends('admin.layouts.app')
@section('title', 'Sosial Media')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-share-nodes"></i> Sosial Media</h2>
        <a href="{{ route('admin.sosmed.create') }}" class="btn btn-primary" style="font-size:0.82rem;padding:0.45rem 1rem;"><i class="fa-solid fa-plus"></i> Tambah</a>
    </div>

    @if($sosmed->isEmpty())
    <div class="empty-state">
        <div class="empty-icon"><i class="fa-solid fa-share-nodes"></i></div>
        <p>Belum ada sosial media. <a href="{{ route('admin.sosmed.create') }}" style="color:var(--accent);font-weight:700;">Tambah sekarang</a></p>
    </div>
    @else
    <table>
        <thead>
            <tr>
                <th>Platform</th>
                <th>Label</th>
                <th>URL</th>
                <th>Urutan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sosmed as $s)
            <tr>
                <td>
                    <span style="display:inline-flex;align-items:center;gap:0.5rem;">
                        <span style="font-size:1.25rem;line-height:1;">
                            @if($s->platform === 'instagram') <i class="fa-brands fa-instagram" style="color:#e1306c;"></i>
                            @elseif($s->platform === 'tiktok') <i class="fa-brands fa-tiktok" style="color:#010101;"></i>
                            @elseif($s->platform === 'facebook') <i class="fa-brands fa-facebook" style="color:#1877f2;"></i>
                            @elseif($s->platform === 'twitter' || $s->platform === 'x-twitter') <i class="fa-brands fa-x-twitter" style="color:#000000;"></i>
                            @elseif($s->platform === 'youtube') <i class="fa-brands fa-youtube" style="color:#ff0000;"></i>
                            @elseif($s->platform === 'linkedin') <i class="fa-brands fa-linkedin" style="color:#0077b5;"></i>
                            @elseif($s->platform === 'github') <i class="fa-brands fa-github" style="color:#333;"></i>
                            @elseif($s->platform === 'whatsapp') <i class="fa-brands fa-whatsapp" style="color:#25d366;"></i>
                            @else <i class="fa-solid fa-globe" style="color:var(--accent);"></i>
                            @endif
                        </span>
                        <span class="td-title">{{ ucfirst($s->platform) }}</span>
                    </span>
                </td>
                <td><span class="td-sub">{{ $s->label }}</span></td>
                <td>
                    <a href="{{ $s->url }}" target="_blank" style="color:var(--accent);font-size:0.8rem;font-weight:600;word-break:break-all;">
                        {{ Str::limit($s->url, 45) }}
                    </a>
                </td>
                <td><span class="td-badge">{{ $s->urutan }}</span></td>
                <td>
                    <div class="td-actions">
                        <a href="{{ route('admin.sosmed.edit', $s) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                        <form method="POST" action="{{ route('admin.sosmed.destroy', $s) }}"
                              onsubmit="return confirm('Hapus sosial media ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm btn-del"><i class="fa-solid fa-trash"></i> Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
