@extends('admin.layouts.app')
@section('title', $item ? 'Edit Projek' : 'Tambah Projek')

@section('content')
<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h2>
                @if($item)<i class="fa-solid fa-pen"></i> Edit Projek
                @else<i class="fa-solid fa-plus"></i> Tambah Projek
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
                                <img src="{{ \App\Support\MediaUrl::from($gPath) }}" alt="Gallery"
                                     style="width:100%;height:100%;object-fit:cover;display:block;">
                                <input type="checkbox" name="hapus_galeri[]" value="{{ $gPath }}" class="hapus-galeri-cb" style="display:none;">
                                <div class="hapus-overlay" style="display:none;position:absolute;inset:0;background:rgba(220,38,38,0.8);align-items:center;justify-content:center;flex-direction:column;color:#fff;gap:5px;pointer-events:none;">
                                    <i class="fa-solid fa-trash" style="font-size:1.8rem;"></i>
                                    <span style="font-size:0.78rem;font-weight:700;">Akan Dihapus</span>
                                    <span style="font-size:0.63rem;opacity:0.85;">Klik tombol merah untuk batal</span>
                                </div>
                                <button type="button" onclick="toggleHapusGaleri(this)" style="position:absolute;top:5px;right:5px;background:rgba(220,38,38,0.85);color:#fff;border:none;border-radius:8px;width:30px;height:30px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:0.78rem;z-index:2;" title="Tandai untuk dihapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
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

                    <div class="form-group full" id="harga-group">
                        <label for="harga">Source Code Premium (opsional)</label>
                        <span class="form-hint">Isi harga dan upload ZIP jika source code dijual. Jika harga dikosongkan, project tetap tampil sebagai demo/GitHub saja.</span>

                        <label for="harga" style="margin-top:1rem;display:block;">Harga (IDR)</label>
                        <div style="position:relative;">
                            <span style="position:absolute;left:1rem;top:50%;transform:translateY(-50%);font-weight:700;color:var(--muted);pointer-events:none;">Rp</span>
                            <input type="number" id="harga" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid' : '' }}"
                                   style="padding-left:3rem;"
                                   value="{{ old('harga', $item?->harga) }}" placeholder="50000" min="1000" step="1000">
                        </div>
                        <span class="form-hint">Minimum Rp 1.000. Contoh: 50000 = Rp 50.000</span>
                        @error('harga') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror

                        <label style="margin-top:1.25rem;display:flex;align-items:center;gap:0.5rem;">
                            <i class="fa-solid fa-file-zipper" style="color:var(--accent);"></i>
                            File ZIP Source Code
                            <span style="font-weight:400;color:var(--faint);font-size:0.8rem;">(wajib jika harga diisi, maks 100MB, format .zip)</span>
                        </label>

                        @if($item?->zip_file)
                        <div id="current-zip" style="display:flex;align-items:center;gap:0.75rem;padding:0.85rem 1rem;background:rgba(255,181,215,0.16);border:1.5px solid rgba(255,181,215,0.35);border-radius:10px;margin-top:0.5rem;">
                            <i class="fa-solid fa-file-zipper" style="font-size:1.5rem;color:var(--accent);flex-shrink:0;"></i>
                            <div style="flex:1;min-width:0;">
                                <div style="font-weight:700;font-size:0.87rem;color:var(--fg);word-break:break-all;">{{ basename($item->zip_file) }}</div>
                                <div style="font-size:0.75rem;color:var(--muted);margin-top:2px;">File ZIP tersimpan di server</div>
                            </div>
                            <label style="display:flex;align-items:center;gap:0.4rem;cursor:pointer;font-size:0.8rem;color:var(--danger);font-weight:700;flex-shrink:0;">
                                <input type="checkbox" name="hapus_zip" value="1" id="hapus_zip">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </label>
                        </div>
                        @endif

                        <div id="zip-upload-area"
                             onclick="document.getElementById('zip_file_input').click()"
                             ondragover="event.preventDefault();this.style.borderColor='var(--primary)'"
                             ondragleave="this.style.borderColor='var(--border)'"
                             ondrop="handleZipDrop(event)"
                             style="border:2px dashed var(--border);border-radius:12px;padding:1.25rem;text-align:center;cursor:pointer;transition:border-color 0.3s;background:var(--bg);margin-top:0.6rem;">
                            <div id="zip-placeholder">
                                <div style="font-size:1.8rem;margin-bottom:0.4rem;color:var(--faint);"><i class="fa-solid fa-file-zipper"></i></div>
                                <div style="font-size:0.85rem;color:var(--muted);font-weight:600;">Klik atau drag & drop file ZIP di sini</div>
                                <div style="font-size:0.75rem;color:var(--faint);margin-top:0.25rem;">Format .zip • Maks 100MB</div>
                            </div>
                            <div id="zip-selected" style="display:none;align-items:center;gap:0.6rem;justify-content:center;">
                                <i class="fa-solid fa-file-zipper" style="font-size:1.5rem;color:var(--accent);"></i>
                                <span id="zip-filename" style="font-weight:700;font-size:0.88rem;color:var(--fg);word-break:break-all;"></span>
                            </div>
                        </div>
                        <input type="file" id="zip_file_input" name="zip_file" accept=".zip" style="display:none;" onchange="previewZip(this)">
                        @error('zip_file') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
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

