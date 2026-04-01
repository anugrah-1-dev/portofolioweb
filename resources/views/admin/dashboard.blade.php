@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.25rem;margin-bottom:2rem;">
    <div class="card" style="border-top:3px solid var(--primary);">
        <div class="card-body" style="display:flex;align-items:center;gap:1.25rem;">
            <div style="font-size:2.5rem;">🏆</div>
            <div>
                <div style="font-size:2rem;font-weight:900;color:var(--primary);">{{ $totalPrestasi }}</div>
                <div style="font-size:0.8rem;font-weight:700;color:var(--faint);text-transform:uppercase;letter-spacing:1px;">Total Prestasi</div>
            </div>
        </div>
    </div>
    <div class="card" style="border-top:3px solid var(--accent);">
        <div class="card-body" style="display:flex;align-items:center;gap:1.25rem;">
            <div style="font-size:2.5rem;">💻</div>
            <div>
                <div style="font-size:2rem;font-weight:900;color:var(--accent);">{{ $totalProjek }}</div>
                <div style="font-size:0.8rem;font-weight:700;color:var(--faint);text-transform:uppercase;letter-spacing:1px;">Total Projek</div>
            </div>
        </div>
    </div>
    <a href="{{ url('/') }}" target="_blank" class="card" style="border-top:3px solid #8aab90;text-decoration:none;">
        <div class="card-body" style="display:flex;align-items:center;gap:1.25rem;">
            <div style="font-size:2.5rem;">🌿</div>
            <div>
                <div style="font-size:2rem;font-weight:900;color:var(--muted);">Live</div>
                <div style="font-size:0.8rem;font-weight:700;color:var(--faint);text-transform:uppercase;letter-spacing:1px;">Lihat Portfolio</div>
            </div>
        </div>
    </a>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem;">
    <!-- Recent Prestasi -->
    <div class="card">
        <div class="card-header">
            <h2>🏆 Prestasi Terbaru</h2>
            <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary" style="padding:0.4rem 0.9rem;font-size:0.78rem;">Lihat Semua</a>
        </div>
        <div style="padding:0.5rem 0;">
            @forelse($recentPrestasi as $item)
            <div style="display:flex;align-items:center;gap:1rem;padding:0.85rem 1.5rem;border-bottom:1px solid rgba(201,223,201,0.4);">
                <span style="font-size:1.5rem;">{{ $item->icon }}</span>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:0.88rem;font-weight:700;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->title }}</div>
                    <div style="font-size:0.75rem;color:var(--faint);">{{ $item->year }} &bull; {{ $item->badge }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state"><p>Belum ada data prestasi.</p></div>
            @endforelse
        </div>
    </div>

    <!-- Recent Projek -->
    <div class="card">
        <div class="card-header">
            <h2>💻 Projek Terbaru</h2>
            <a href="{{ route('admin.projek.index') }}" class="btn btn-secondary" style="padding:0.4rem 0.9rem;font-size:0.78rem;">Lihat Semua</a>
        </div>
        <div style="padding:0.5rem 0;">
            @forelse($recentProjek as $item)
            <div style="display:flex;align-items:center;gap:1rem;padding:0.85rem 1.5rem;border-bottom:1px solid rgba(201,223,201,0.4);">
                <span style="font-size:1.5rem;">{{ $item->icon }}</span>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:0.88rem;font-weight:700;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $item->title }}</div>
                    <div style="font-size:0.75rem;color:var(--faint);">{{ implode(', ', $item->tags ?? []) }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state"><p>Belum ada data projek.</p></div>
            @endforelse
        </div>
    </div>
</div>
@endsection
