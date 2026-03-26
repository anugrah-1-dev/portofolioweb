@extends('admin.layouts.app')
@section('title', $item ? 'Edit Prestasi' : 'Tambah Prestasi')

@section('content')
<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h2>{{ $item ? '✏️ Edit Prestasi' : '➕ Tambah Prestasi' }}</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ $item ? route('admin.prestasi.update', $item) : route('admin.prestasi.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <input type="text" id="year" name="year" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}"
                               value="{{ old('year', $item?->year) }}" placeholder="2024" maxlength="4">
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="title">Judul Prestasi</label>
                        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $item?->title) }}" placeholder="Juara 1 Web Development Competition">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Jelaskan prestasi ini...">{{ old('description', $item?->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="badge">Badge / Kategori Label</label>
                        <input type="text" id="badge" name="badge" class="form-control {{ $errors->has('badge') ? 'is-invalid' : '' }}"
                               value="{{ old('badge', $item?->badge ?? 'Kompetisi') }}"
                               placeholder="Kompetisi / Sertifikasi / Akademik">
                        @error('badge') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="kategori">Jenis Prestasi</label>
                        <select id="kategori" name="kategori" class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}">
                            <option value="akademik" {{ old('kategori', $item?->kategori) === 'akademik' ? 'selected' : '' }}>🎓 Prestasi Akademik</option>
                            <option value="non_akademik" {{ old('kategori', $item?->kategori) === 'non_akademik' ? 'selected' : '' }}>🏆 Prestasi Non-Akademik</option>
                        </select>
                        @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- FOTO UPLOAD --}}
                    <div class="form-group full">
                        <label>Foto Prestasi <span style="font-weight:400;color:var(--faint)">(opsional, JPG/PNG/WebP, maks 2MB)</span></label>

                        {{-- Preview foto existing --}}
                        @if($item?->foto)
                        <div id="current-foto" style="margin-bottom:0.75rem;">
                            <img src="{{ Storage::url($item->foto) }}" alt="Foto Prestasi"
                                 style="width:200px;height:140px;object-fit:cover;border-radius:12px;border:2px solid var(--border);">
                            <div style="margin-top:0.5rem;display:flex;align-items:center;gap:0.5rem;">
                                <input type="checkbox" name="hapus_foto" id="hapus_foto" value="1">
                                <label for="hapus_foto" style="font-size:0.82rem;color:var(--danger);font-weight:600;cursor:pointer;">
                                    🗑️ Hapus foto ini
                                </label>
                            </div>
                        </div>
                        @endif

                        {{-- Upload area --}}
                        <div id="upload-area" style="border:2px dashed var(--border);border-radius:12px;padding:1.75rem;text-align:center;cursor:pointer;transition:all 0.3s;background:var(--bg);"
                             onclick="document.getElementById('foto').click()"
                             ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                             ondragleave="this.style.borderColor='var(--border)'"
                             ondrop="handleDrop(event)">
                            <div id="upload-placeholder">
                                <div style="font-size:2rem;margin-bottom:0.5rem;">📷</div>
                                <div style="font-size:0.88rem;color:var(--muted);font-weight:600;">Klik atau drag & drop foto di sini</div>
                                <div style="font-size:0.78rem;color:var(--faint);margin-top:0.3rem;">JPG, PNG, WebP • Maks 2MB</div>
                            </div>
                            <img id="foto-preview" src="#" alt="Preview"
                                 style="display:none;max-width:100%;max-height:200px;border-radius:10px;object-fit:contain;">
                        </div>
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp"
                               style="display:none;" onchange="previewFoto(this)">
                        @error('foto') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="urutan">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" class="form-control"
                               value="{{ old('urutan', $item?->urutan ?? 0) }}" min="0">
                        <span class="form-hint">Angka lebih kecil tampil lebih dulu.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        {{ $item ? '💾 Simpan Perubahan' : '✅ Tambah Prestasi' }}
                    </button>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewFoto(input) {
    const preview = document.getElementById('foto-preview');
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
        const input = document.getElementById('foto');
        const dt = new DataTransfer();
        dt.items.add(file);
        input.files = dt.files;
        previewFoto(input);
    }
}
</script>
@endsection

