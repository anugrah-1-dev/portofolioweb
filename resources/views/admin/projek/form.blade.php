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

                    {{-- GAMBAR UPLOAD --}}
                    <div class="form-group full">
                        <label>Gambar Projek <span style="font-weight:400;color:var(--faint)">(opsional, JPG/PNG/WebP, maks 2MB)</span></label>

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
</script>
@endsection

