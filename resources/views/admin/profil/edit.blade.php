@extends('admin.layouts.app')
@section('title', 'Tentang Saya')

@section('content')
<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h2>👤 Edit Profil Tentang Saya</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                               value="{{ old('nama', $profil->nama) }}" placeholder="Nama lengkap">
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" class="form-control"
                               value="{{ old('status', $profil->status) }}" placeholder="Tersedia / Full-time / Lainnya">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control"
                               value="{{ old('lokasi', $profil->lokasi) }}" placeholder="Indonesia">
                    </div>
                    <div class="form-group">
                        <label for="bahasa">Bahasa</label>
                        <input type="text" id="bahasa" name="bahasa" class="form-control"
                               value="{{ old('bahasa', $profil->bahasa) }}" placeholder="ID / EN">
                    </div>
                    <div class="form-group full">
                        <label for="bio1">Bio Paragraf 1</label>
                        <textarea id="bio1" name="bio1" class="form-control"
                                  placeholder="Perkenalan singkat tentang diri kamu...">{{ old('bio1', $profil->bio1) }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label for="bio2">Bio Paragraf 2 <span style="font-weight:400;color:var(--faint)">(opsional)</span></label>
                        <textarea id="bio2" name="bio2" class="form-control"
                                  placeholder="Lanjutan cerita atau prinsip kerja...">{{ old('bio2', $profil->bio2) }}</textarea>
                    </div>
                    <div class="form-group full">
                        <label for="keahlian_raw">Keahlian Teknis</label>
                        <input type="text" id="keahlian_raw" name="keahlian_raw" class="form-control"
                               value="{{ old('keahlian_raw', implode(', ', $profil->keahlian ?? [])) }}"
                               placeholder="PHP, Laravel, Vue.js, MySQL, JavaScript, Git">
                        <span class="form-hint">Pisahkan dengan koma. Contoh: PHP, Laravel, Vue.js, MySQL</span>
                    </div>

                    {{-- Foto Profil --}}
                    <div class="form-group full">
                        <label for="foto">Foto Profil (Home)</label>
                        @if($profil->foto)
                        <div style="margin-bottom:0.75rem;">
                            <img src="{{ Storage::url($profil->foto) }}" alt="Foto Profil"
                                 style="width:120px;height:120px;object-fit:cover;border-radius:50%;border:3px solid var(--border);">
                            <div style="margin-top:0.5rem;">
                                <label style="font-size:0.85rem;color:var(--muted);cursor:pointer;">
                                    <input type="checkbox" name="hapus_foto" value="1"> Hapus foto
                                </label>
                            </div>
                        </div>
                        @endif
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                        @error('foto') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                        <span class="form-hint">Format: JPG, PNG, WEBP. Maks: 2MB. Foto akan tampil di bagian Home.</span>
                    </div>

                    {{-- Kata Penyemangat --}}
                    <div class="form-group full">
                        <label for="kata_penyemangat_raw">Kata Penyemangat (Floating Tags Home)</label>
                        <input type="text" id="kata_penyemangat_raw" name="kata_penyemangat_raw" class="form-control"
                               value="{{ old('kata_penyemangat_raw', implode(', ', $profil->kata_penyemangat ?? [])) }}"
                               placeholder="Semangat!, Pantang Menyerah, Terus Belajar">
                        <span class="form-hint">Pisahkan dengan koma (maksimal 3). Akan tampil sebagai tag melayang di sekitar foto.</span>
                    </div>

                    {{-- No. WhatsApp --}}
                    <div class="form-group full">
                        <label for="no_whatsapp">No. WhatsApp (Tombol Hubungi Saya)</label>
                        <input type="text" id="no_whatsapp" name="no_whatsapp" class="form-control"
                               value="{{ old('no_whatsapp', $profil->no_whatsapp) }}"
                               placeholder="6281234567890">
                        <span class="form-hint">Gunakan format internasional tanpa + (contoh: 6281234567890). Akan tampil sebagai tombol WhatsApp di Home.</span>
                    </div>

                    {{-- Upload CV --}}
                    <div class="form-group full">
                        <label for="cv_file">File CV <span style="font-weight:400;color:var(--faint)">(PDF/DOC/DOCX, maks 5MB)</span></label>
                        @if($profil->cv_file)
                        <div style="margin-bottom:0.75rem;padding:0.75rem 1rem;background:rgba(45,106,79,0.08);border-radius:10px;border:1.5px solid rgba(45,106,79,0.2);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
                            <span style="font-size:0.9rem;color:var(--text);font-weight:600;">
                                📄 {{ basename($profil->cv_file) }}
                            </span>
                            <div style="display:flex;gap:0.75rem;align-items:center;">
                                <a href="{{ Storage::url($profil->cv_file) }}" target="_blank"
                                   style="font-size:0.85rem;color:var(--accent);font-weight:700;text-decoration:none;">&#128279; Lihat File</a>
                                <label style="font-size:0.85rem;color:#dc2626;cursor:pointer;font-weight:600;">
                                    <input type="checkbox" name="hapus_cv" value="1"> Hapus CV
                                </label>
                            </div>
                        </div>
                        @endif
                        <input type="file" id="cv_file" name="cv_file" class="form-control" accept=".pdf,.doc,.docx">
                        @error('cv_file') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                        <span class="form-hint">CV yang diupload akan bisa didownload oleh pengunjung dari halaman Tentang Saya.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>

    <div style="margin-top:1.5rem;padding:1rem 1.25rem;background:rgba(13,148,136,0.08);border-radius:12px;border:1.5px solid rgba(13,148,136,0.2);font-size:0.85rem;color:var(--muted);">
        💡 <strong>Tips:</strong> Untuk mengelola ikon sosial media (Instagram, TikTok, Facebook), buka menu
        <a href="{{ route('admin.sosmed.index') }}" style="color:var(--accent);font-weight:700;">Sosial Media</a> di sidebar.
    </div>
</div>
@endsection
