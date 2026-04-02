@extends('admin.layouts.app')
@section('title', $item ? 'Edit Projek' : 'Tambah Projek')

@section('content')
<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h2>
                @if($item)<i class="fa-solid fa-pen"></i> Edit Projek
                @else<i class="fa-solid fa-plus"></i> Tambah Projek
                @endif
            </h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ $item ? route('admin.projek.update', $item) : route('admin.projek.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label for="thumb_color">Warna Latar (jika tanpa gambar)</label>
                        <select id="thumb_color" name="thumb_color" class="form-control">
                            <option value="1" {{ old('thumb_color', $item?->thumb_color) == 1 ? 'selected' : '' }}>Hijau Muda</option>
                            <option value="2" {{ old('thumb_color', $item?->thumb_color) == 2 ? 'selected' : '' }}>Teal Muda</option>
                            <option value="3" {{ old('thumb_color', $item?->thumb_color) == 3 ? 'selected' : '' }}>Biru-Hijau</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="urutan">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" class="form-control"
                               value="{{ old('urutan', $item?->urutan ?? 0) }}" min="0">
                        <span class="form-hint">Angka lebih kecil tampil lebih dulu.</span>
                    </div>
                    <div class="form-group full">
                        <label for="title">Judul Projek</label>
                        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $item?->title) }}" placeholder="Nama projek...">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Jelaskan projek ini...">{{ old('description', $item?->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="tags_raw">Tags Teknologi</label>
                        <input type="text" id="tags_raw" name="tags_raw" class="form-control"
                               value="{{ old('tags_raw', $item ? implode(', ', $item->tags ?? []) : '') }}"
                               placeholder="Laravel, Vue.js, MySQL, Tailwind">
                        <span class="form-hint">Pisahkan dengan koma.</span>
                    </div>

                    {{-- GAMBAR COVER --}}
                    <div class="form-group full">
                        <label>Gambar Utama / Cover <span style="font-weight:400;color:var(--faint)">(opsional, JPG/PNG/WebP, maks 2MB)</span></label>

                        @if($item?->gambar)
                        <div id="current-gambar" style="margin-bottom:0.75rem;">
                            <img src="{{ Storage::url($item->gambar) }}" alt="Gambar Projek"
                                 style="width:260px;height:160px;object-fit:cover;border-radius:12px;border:2px solid var(--border);">
                            <div style="margin-top:0.5rem;display:flex;align-items:center;gap:0.5rem;">
                                <input type="checkbox" name="hapus_gambar" id="hapus_gambar" value="1">
                                <label for="hapus_gambar" style="font-size:0.82rem;color:var(--danger);font-weight:600;cursor:pointer;">
                                    <i class="fa-solid fa-trash"></i> Hapus gambar ini
                                </label>
                            </div>
                        </div>
                        @endif

                        <div id="upload-area" style="border:2px dashed var(--border);border-radius:12px;padding:1.75rem;text-align:center;cursor:pointer;transition:all 0.3s;background:var(--bg);"
                             onclick="document.getElementById('gambar').click()"
                             ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                             ondragleave="this.style.borderColor='var(--border)'"
                             ondrop="handleDrop(event)">
                            <div id="upload-placeholder">
                                <div style="font-size:2rem;margin-bottom:0.5rem;"><i class="fa-regular fa-image" style="color:var(--faint);"></i></div>
                                <div style="font-size:0.88rem;color:var(--muted);font-weight:600;">Klik atau drag & drop gambar di sini</div>
                                <div style="font-size:0.78rem;color:var(--faint);margin-top:0.3rem;">JPG, PNG, WebP • Maks 2MB</div>
                            </div>
                            <img id="gambar-preview" alt="Preview"
                                 style="display:none;max-width:100%;max-height:200px;border-radius:10px;object-fit:contain;">
                        </div>
                        <input type="file" id="gambar" name="gambar" accept="image/jpeg,image/png,image/webp"
                               style="display:none;" onchange="previewGambar(this)">
                        @error('gambar') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>

                    {{-- GALERI / SCREENSHOT TAMBAHAN --}}
                    <div class="form-group full">
                        <label style="display:flex;align-items:center;gap:0.5rem;">
                            <i class="fa-solid fa-images" style="color:var(--accent);"></i>
                            Galeri / Screenshot Tambahan
                            <span style="font-weight:400;color:var(--faint);font-size:0.8rem;">(bisa banyak, maks 10 gambar, tiap maks 2MB)</span>
                        </label>

                        {{-- Existing gallery --}}
                        @if($item?->galeri && count($item->galeri) > 0)
                        <div class="galeri-grid" id="galeri-existing" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.75rem;margin-bottom:0.85rem;">
                            @foreach($item->galeri as $gPath)
                            <div class="galeri-item" style="position:relative;border-radius:10px;overflow:hidden;aspect-ratio:4/3;background:var(--bg);border:2px solid var(--border);">
                                <img src="{{ Storage::url($gPath) }}" alt="Gallery"
                                     style="width:100%;height:100%;object-fit:cover;display:block;">
                                <label style="position:absolute;top:5px;right:5px;background:rgba(220,38,38,0.85);color:#fff;border-radius:8px;width:28px;height:28px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:0.75rem;" title="Hapus gambar ini">
                                    <input type="checkbox" name="hapus_galeri[]" value="{{ $gPath }}" style="display:none;" onchange="this.parentElement.style.background=this.checked?'rgba(220,38,38,1)':'rgba(220,38,38,0.85)'">
                                    <i class="fa-solid fa-trash"></i>
                                </label>
                                <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,0.55);color:rgba(255,255,255,0.7);font-size:0.62rem;text-align:center;padding:2px 4px;">Centang untuk hapus</div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Preview baru --}}
                        <div id="galeri-preview-grid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:0.75rem;margin-bottom:0.75rem;"></div>

                        {{-- Upload area --}}
                        <div id="galeri-upload-area"
                             onclick="document.getElementById('galeri_baru').click()"
                             ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                             ondragleave="this.style.borderColor='var(--border)'"
                             ondrop="handleGaleriDrop(event)"
                             style="border:2px dashed var(--border);border-radius:12px;padding:1.25rem;text-align:center;cursor:pointer;transition:border-color 0.3s;background:var(--bg);">
                            <div style="font-size:1.6rem;margin-bottom:0.4rem;color:var(--faint);"><i class="fa-solid fa-images"></i></div>
                            <div style="font-size:0.85rem;color:var(--muted);font-weight:600;">Klik atau drag & drop untuk tambah screenshot</div>
                            <div style="font-size:0.75rem;color:var(--faint);margin-top:0.25rem;">Bisa pilih banyak sekaligus • JPG, PNG, WebP • Maks 2MB/file</div>
                        </div>
                        <input type="file" id="galeri_baru" name="galeri_baru[]" multiple
                               accept="image/jpeg,image/png,image/webp" style="display:none;"
                               onchange="previewGaleri(this)">
                        @error('galeri_baru.*') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="demo_url">URL Demo (opsional)</label>
                        <input type="url" id="demo_url" name="demo_url" class="form-control {{ $errors->has('demo_url') ? 'is-invalid' : '' }}"
                               value="{{ old('demo_url', $item?->demo_url) }}" placeholder="https://...">
                        @error('demo_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="github_url">URL GitHub (opsional)</label>
                        <input type="url" id="github_url" name="github_url" class="form-control {{ $errors->has('github_url') ? 'is-invalid' : '' }}"
                               value="{{ old('github_url', $item?->github_url) }}" placeholder="https://github.com/...">
                        @error('github_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- AKSES & HARGA --}}
                    <div class="form-group full">
                        <label>Tipe Akses Source Code</label>
                        <div style="display:flex;gap:1.5rem;margin-top:0.5rem;flex-wrap:wrap;">
                            <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-weight:600;">
                                <input type="radio" name="tipe_akses" value="gratis"
                                       onchange="toggleHarga(this)"
                                       {{ old('tipe_akses', $item?->tipe_akses ?? 'gratis') === 'gratis' ? 'checked' : '' }}>
                                <i class="fa-solid fa-unlock"></i> Gratis
                            </label>
                            <label style="display:flex;align-items:center;gap:0.5rem;cursor:pointer;font-weight:600;">
                                <input type="radio" name="tipe_akses" value="berbayar"
                                       onchange="toggleHarga(this)"
                                       {{ old('tipe_akses', $item?->tipe_akses) === 'berbayar' ? 'checked' : '' }}>
                                <i class="fa-solid fa-credit-card"></i> Berbayar (via Midtrans)
                            </label>
                        </div>
                        <span class="form-hint">Jika berbayar, pengunjung harus membayar untuk mendapatkan link GitHub.</span>
                    </div>
                    <div class="form-group full" id="harga-group"
                         style="{{ (old('tipe_akses', $item?->tipe_akses ?? 'gratis') === 'berbayar') ? '' : 'display:none;' }}">
                        <label for="harga">Harga (IDR)</label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:1rem;top:50%;transform:translateY(-50%);font-weight:700;color:var(--muted);pointer-events:none;">Rp</span>
                            <input type="number" id="harga" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}"
                                   style="padding-left:3rem;"
                                   value="{{ old('harga', $item?->harga) }}" placeholder="50000" min="1000" step="1000">
                        </div>
                        <span class="form-hint">Minimum Rp 1.000. Contoh: 50000 = Rp 50.000</span>
                        @error('harga') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
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
function toggleHarga(radio) {
    document.getElementById('harga-group').style.display =
        radio.value === 'berbayar' ? '' : 'none';
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
            badge.style.cssText = 'position:absolute;bottom:0;left:0;right:0;background:rgba(13,148,136,0.75);color:#fff;font-size:0.62rem;text-align:center;padding:3px;';
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
</script>
@endsection

