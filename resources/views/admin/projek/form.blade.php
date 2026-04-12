@extends('admin.layouts.app')
@section('title', $item ? 'Edit Projek' : 'Tambah Projek')

@section('content')
<div style="max-width:760px;">
    <div class="card">
        <div class="card-header">
            <h2>
                @if($item)<i class="fa-solid fa-pen"></i> Edit Projek
                @else<i class="fa-solid fa-plus"></i> Tambah Projek
                @endif
            </h2>
        </div>
        <div class="card-body">
            <form method="POST"
                  enctype="multipart/form-data"
                  action="{{ $item ? route('admin.projek.update', $item) : route('admin.projek.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    {{-- Judul --}}
                    <div class="form-group full">
                        <label for="title">Judul Projek</label>
                        <input type="text" id="title" name="title"
                               class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $item?->title) }}"
                               placeholder="Nama projek...">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group full">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description"
                                  class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  rows="4"
                                  placeholder="Penjelasan singkat tentang projek...">{{ old('description', $item?->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Tags --}}
                    <div class="form-group full">
                        <label for="tags_raw">Tags / Teknologi</label>
                        <input type="text" id="tags_raw" name="tags_raw"
                               class="form-control {{ $errors->has('tags_raw') ? 'is-invalid' : '' }}"
                               value="{{ old('tags_raw', $item ? implode(', ', $item->tags ?? []) : '') }}"
                               placeholder="Laravel, Vue.js, MySQL, ...">
                        <span class="form-hint">Pisahkan dengan koma. Contoh: Laravel, MySQL, Bootstrap</span>
                    </div>

                    {{-- Warna Thumbnail --}}
                    <div class="form-group full">
                        <label>Warna Thumbnail</label>
                        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;margin-top:0.4rem;">
                            <label style="display:flex;align-items:center;gap:0.5rem;padding:0.55rem 1.1rem;border-radius:8px;border:2px solid var(--border);cursor:pointer;">
                                <input type="radio" name="thumb_color" value="1" {{ old('thumb_color', $item?->thumb_color ?? 1) == 1 ? 'checked' : '' }}>
                                <i class="fa-solid fa-code" style="color:#ff6fac;"></i>
                                <span style="font-size:0.85rem;font-weight:600;">Pink / Web</span>
                            </label>
                            <label style="display:flex;align-items:center;gap:0.5rem;padding:0.55rem 1.1rem;border-radius:8px;border:2px solid var(--border);cursor:pointer;">
                                <input type="radio" name="thumb_color" value="2" {{ old('thumb_color', $item?->thumb_color ?? 1) == 2 ? 'checked' : '' }}>
                                <i class="fa-solid fa-mobile-screen-button" style="color:#a78bfa;"></i>
                                <span style="font-size:0.85rem;font-weight:600;">Purple / Mobile</span>
                            </label>
                            <label style="display:flex;align-items:center;gap:0.5rem;padding:0.55rem 1.1rem;border-radius:8px;border:2px solid var(--border);cursor:pointer;">
                                <input type="radio" name="thumb_color" value="3" {{ old('thumb_color', $item?->thumb_color ?? 1) == 3 ? 'checked' : '' }}>
                                <i class="fa-solid fa-database" style="color:#2dd4bf;"></i>
                                <span style="font-size:0.85rem;font-weight:600;">Teal / Database</span>
                            </label>
                        </div>
                        @error('thumb_color') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>

                    {{-- GAMBAR UTAMA --}}
                    <div class="form-group full">
                        <label><i class="fa-solid fa-image" style="color:var(--accent);"></i> Gambar Utama (Cover)</label>

                        @if($item?->gambar)
                        <div style="display:flex;align-items:center;gap:0.85rem;padding:0.85rem;background:rgba(255,181,215,0.1);border:1.5px solid rgba(255,181,215,0.3);border-radius:10px;margin-bottom:0.75rem;">
                            <img src="{{ \App\Support\MediaUrl::from($item->gambar) }}" alt="Cover"
                                 style="width:80px;height:60px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                            <div>
                                <div style="font-size:0.82rem;color:var(--muted);">Gambar cover saat ini</div>
                                <label style="display:inline-flex;align-items:center;gap:0.4rem;margin-top:0.4rem;cursor:pointer;font-size:0.82rem;color:var(--danger);font-weight:600;">
                                    <input type="checkbox" name="hapus_gambar" id="hapus_gambar" value="1">
                                    <i class="fa-solid fa-trash"></i> Hapus gambar ini
                                </label>
                            </div>
                        </div>
                        @endif

                        <div id="upload-area"
                             style="border:2px dashed var(--border);border-radius:12px;padding:1.75rem;text-align:center;cursor:pointer;transition:all 0.3s;background:var(--bg);"
                             onclick="document.getElementById('gambar').click()"
                             ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                             ondragleave="this.style.borderColor='var(--border)'"
                             ondrop="handleDrop(event)">
                            <div id="upload-placeholder">
                                <div style="font-size:2rem;margin-bottom:0.5rem;"><i class="fa-regular fa-image" style="color:var(--faint);"></i></div>
                                <div style="font-size:0.88rem;color:var(--muted);font-weight:600;">Klik atau drag &amp; drop gambar di sini</div>
                                <div style="font-size:0.78rem;color:var(--faint);margin-top:0.3rem;">JPG, PNG, WebP &bull; Maks 5MB</div>
                            </div>
                            <img id="gambar-preview" alt="Preview"
                                 style="display:none;max-width:100%;max-height:200px;border-radius:10px;object-fit:contain;">
                        </div>
                        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/webp"
                               style="display:none;" onchange="previewGambar(this)">
                        @error('gambar') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>

                    {{-- GALERI --}}
                    <div class="form-group full">
                        <label style="display:flex;align-items:center;gap:0.5rem;">
                            <i class="fa-solid fa-images" style="color:var(--accent);"></i>
                            Galeri / Screenshot Tambahan
                            <span style="font-weight:400;color:var(--faint);font-size:0.8rem;">(maks 10 gambar, tiap maks 5MB)</span>
                        </label>

                        @if($item?->galeri && count($item->galeri) > 0)
                        <div id="galeri-existing"
                             style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.75rem;margin-bottom:0.85rem;">
                            @foreach($item->galeri as $gPath)
                            <div class="galeri-item"
                                 style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:4/3;background:var(--bg);border:2px solid var(--border);">
                                <img src="{{ \App\Support\MediaUrl::from($gPath) }}" alt="Gallery"
                                     style="width:100%;height:100%;object-fit:cover;display:block;">
                                <input type="checkbox" name="hapus_galeri[]" value="{{ $gPath }}"
                                       class="hapus-galeri-cb" style="display:none;">
                                <div class="hapus-overlay"
                                     style="display:none;position:absolute;inset:0;background:rgba(220,38,38,0.8);align-items:center;justify-content:center;flex-direction:column;color:#fff;gap:5px;pointer-events:none;">
                                    <i class="fa-solid fa-trash" style="font-size:1.8rem;"></i>
                                    <span style="font-size:0.78rem;font-weight:700;">Akan Dihapus</span>
                                </div>
                                <button type="button" onclick="toggleHapusGaleri(this)"
                                        style="position:absolute;top:5px;right:5px;background:rgba(220,38,38,0.85);color:#fff;border:none;border-radius:8px;width:30px;height:30px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:0.78rem;z-index:2;"
                                        title="Tandai untuk dihapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div id="galeri-preview-grid"
                             style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.75rem;margin-bottom:0.75rem;"></div>

                        <div id="galeri-upload-area"
                             onclick="document.getElementById('galeri_baru').click()"
                             ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                             ondragleave="this.style.borderColor='var(--border)'"
                             ondrop="handleGaleriDrop(event)"
                             style="border:2px dashed var(--border);border-radius:12px;padding:1.25rem;text-align:center;cursor:pointer;transition:border-color 0.3s;background:var(--bg);">
                            <div style="font-size:1.6rem;margin-bottom:0.4rem;color:var(--faint);"><i class="fa-solid fa-images"></i></div>
                            <div style="font-size:0.85rem;color:var(--muted);font-weight:600;">Klik atau drag &amp; drop untuk tambah screenshot</div>
                            <div style="font-size:0.75rem;color:var(--faint);margin-top:0.25rem;">Bisa pilih banyak sekaligus &bull; JPG, PNG, WebP</div>
                        </div>
                        <input type="file" id="galeri_baru" name="galeri_baru[]" multiple
                               accept="image/jpeg,image/png,image/webp" style="display:none;"
                               onchange="previewGaleri(this)">
                        @error('galeri_baru.*') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>

                    {{-- Demo & GitHub --}}
                    <div class="form-group">
                        <label for="demo_url">URL Demo <span style="font-weight:400;color:var(--faint);">(opsional)</span></label>
                        <input type="url" id="demo_url" name="demo_url"
                               class="form-control {{ $errors->has('demo_url') ? 'is-invalid' : '' }}"
                               value="{{ old('demo_url', $item?->demo_url) }}"
                               placeholder="https://...">
                        @error('demo_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="github_url">URL GitHub <span style="font-weight:400;color:var(--faint);">(opsional)</span></label>
                        <input type="url" id="github_url" name="github_url"
                               class="form-control {{ $errors->has('github_url') ? 'is-invalid' : '' }}"
                               value="{{ old('github_url', $item?->github_url) }}"
                               placeholder="https://github.com/...">
                        @error('github_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Urutan --}}
                    <div class="form-group">
                        <label for="urutan">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" class="form-control"
                               value="{{ old('urutan', $item?->urutan ?? 0) }}" min="0">
                        <span class="form-hint">Angka lebih kecil tampil lebih dulu.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        {!! $item ? '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan' : '<i class="fa-solid fa-plus"></i> Tambah Projek' !!}
                    </button>
                    <a href="{{ route('admin.projek.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewGambar(input) {
    const preview = document.getElementById('gambar-preview');
    const placeholder = document.getElementById('upload-placeholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function handleDrop(event) {
    event.preventDefault();
    document.getElementById('upload-area').style.borderColor = 'var(--border)';
    const file = event.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        const input = document.getElementById('gambar');
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        previewGambar(input);
    }
}
function previewGaleri(input) {
    const grid = document.getElementById('galeri-preview-grid');
    const files = Array.from(input.files);
    files.forEach(function(file) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const wrap = document.createElement('div');
            wrap.style.cssText = 'position:relative;border-radius:10px;overflow:hidden;aspect-ratio:4/3;background:var(--bg);border:2px solid var(--accent);';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
            const badge = document.createElement('div');
            badge.style.cssText = 'position:absolute;bottom:0;left:0;right:0;background:rgba(255,143,192,0.85);color:#fff;font-size:0.62rem;text-align:center;padding:3px;';
            badge.textContent = 'Akan diupload';
            wrap.appendChild(img);
            wrap.appendChild(badge);
            grid.appendChild(wrap);
        };
        reader.readAsDataURL(file);
    });
}
function handleGaleriDrop(event) {
    event.preventDefault();
    document.getElementById('galeri-upload-area').style.borderColor = 'var(--border)';
    const dt = new DataTransfer();
    const existing = document.getElementById('galeri_baru').files;
    Array.from(existing).forEach(f => dt.items.add(f));
    Array.from(event.dataTransfer.files).filter(f => f.type.startsWith('image/')).forEach(f => dt.items.add(f));
    document.getElementById('galeri_baru').files = dt.files;
    previewGaleri({ files: event.dataTransfer.files });
}
function toggleHapusGaleri(btn) {
    const item = btn.closest('.galeri-item');
    const cb = item.querySelector('.hapus-galeri-cb');
    cb.checked = !cb.checked;
    const overlay = item.querySelector('.hapus-overlay');
    overlay.style.display = cb.checked ? 'flex' : 'none';
    item.style.border = cb.checked ? '2px solid rgba(220,38,38,0.9)' : '2px solid var(--border)';
    btn.style.background = cb.checked ? 'rgba(220,38,38,1)' : 'rgba(220,38,38,0.85)';
    btn.title = cb.checked ? 'Batal hapus' : 'Tandai untuk dihapus';
}
</script>
@endsection