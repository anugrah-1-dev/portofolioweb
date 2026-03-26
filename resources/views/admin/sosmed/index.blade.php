@extends('admin.layouts.app')
@section('title', 'Sosial Media')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>📱 Sosial Media</h2>
        <a href="{{ route('admin.sosmed.create') }}" class="btn btn-primary" style="font-size:0.82rem;padding:0.45rem 1rem;">➕ Tambah</a>
    </div>

    @if($sosmed->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">📱</div>
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
                        <span style="font-size:1.4rem;">
                            @if($s->platform === 'instagram') 📸
                            @elseif($s->platform === 'tiktok') 🎵
                            @elseif($s->platform === 'facebook') 📘
                            @elseif($s->platform === 'twitter' || $s->platform === 'x-twitter') 🐦
                            @elseif($s->platform === 'youtube') 📺
                            @elseif($s->platform === 'linkedin') 💼
                            @elseif($s->platform === 'github') 🐙
                            @elseif($s->platform === 'whatsapp') 💬
                            @else 🌐
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
                        <a href="{{ route('admin.sosmed.edit', $s) }}" class="btn-sm btn-edit">✏️ Edit</a>
                        <form method="POST" action="{{ route('admin.sosmed.destroy', $s) }}"
                              onsubmit="return confirm('Hapus sosial media ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-sm btn-del">🗑️ Hapus</button>
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
