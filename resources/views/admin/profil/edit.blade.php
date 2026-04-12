@extends('admin.layouts.app')
@section('title', 'Tentang Saya')

@section('content')
<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h2><i class="fa-solid fa-user"></i> Edit Profil Tentang Saya</h2>
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
                        <label for="status">Email</label>
                        <input type="text" id="status" name="status" class="form-control"
                               value="{{ old('status', $profil->status) }}" placeholder="email@contoh.com">
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" class="form-control"
                               value="{{ old('lokasi', $profil->lokasi) }}" placeholder="Indonesia">
                    </div>
                    <div class="form-group">
                        <label for="bahasa">No. Telepon</label>
                        <input type="text" id="bahasa" name="bahasa" class="form-control"
                               value="{{ old('bahasa', $profil->bahasa) }}" placeholder="+62 812 xxxx xxxx">
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
                        <label for="deskripsi_home">Deskripsi Home (Halaman Utama)</label>
                        <textarea id="deskripsi_home" name="deskripsi_home" class="form-control"
                                  rows="3"
                                  placeholder="Teks singkat yang tampil di bawah nama pada halaman utama...">{{ old('deskripsi_home', $profil->deskripsi_home) }}</textarea>
                        <span class="form-hint">Tampil sebagai paragraf deskripsi di bawah nama pada halaman Home.</span>
                    </div>
                    <div class="form-group full">
                        <label for="keahlian_raw">Keahlian Teknis</label>
                        <input type="text" id="keahlian_raw" name="keahlian_raw" class="form-control"
                               value="{{ old('keahlian_raw', implode(', ', $profil->keahlian ?? [])) }}"
                               placeholder="PHP, Laravel, Vue.js, MySQL, JavaScript, Git">
                        <span class="form-hint">Pisahkan dengan koma. Contoh: PHP, Laravel, Vue.js, MySQL</span>
                    </div>

                    {{-- Logo Brand Navbar --}}
                    <div class="form-group full">
                        <label for="logo">Logo Brand (Navbar)</label>
                        @if($profil->logo)
                        <div style="margin-bottom:0.75rem;display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
                            <img src="{{ Storage::url($profil->logo) }}" alt="Logo Brand"
                                 style="width:120px;height:120px;object-fit:contain;border-radius:14px;border:2px solid var(--border);background:var(--bg);padding:8px;">
                            <div>
                                <div style="font-size:0.82rem;color:var(--muted);margin-bottom:0.35rem;">Logo aktif di navbar</div>
                                <label style="font-size:0.85rem;color:var(--muted);cursor:pointer;">
                                    <input type="checkbox" name="hapus_logo" value="1"> Hapus logo
                                </label>
                            </div>
                        </div>
                        @endif
                        <input type="file" id="logo" name="logo" class="form-control" accept="image/*">
                        @error('logo') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                        <span class="form-hint">Format: JPG, PNG, WEBP, SVG. Maks: 5MB. Logo tampil di kiri navbar, di samping nama.</span>
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

                    {{-- Foto Profil 2 (Badge Card) --}}
                    <div class="form-group full">
                        <label for="foto2">Foto Profil 2 (Badge Card Home)</label>
                        @if($profil->foto2)
                        <div style="margin-bottom:0.75rem;">
                            <img src="{{ Storage::url($profil->foto2) }}" alt="Foto Badge"
                                 style="width:120px;height:120px;object-fit:cover;border-radius:50%;border:3px solid var(--border);">
                            <div style="margin-top:0.5rem;">
                                <label style="font-size:0.85rem;color:var(--muted);cursor:pointer;">
                                    <input type="checkbox" name="hapus_foto2" value="1"> Hapus foto 2
                                </label>
                            </div>
                        </div>
                        @endif
                        <input type="file" id="foto2" name="foto2" class="form-control" accept="image/*">
                        @error('foto2') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                        <span class="form-hint">Format: JPG, PNG, WEBP. Maks: 2MB. Foto yang tampil di kartu badge Home. Jika kosong, otomatis pakai Foto Profil.</span>
                    </div>

                    {{-- Hero Role & Status --}}
                    <div class="form-group" style="grid-column:1">
                        <label for="hero_role1">Role Badge 1 (Hero Home)</label>
                        <input type="text" id="hero_role1" name="hero_role1" class="form-control"
                               value="{{ old('hero_role1', $profil->hero_role1 ?? 'Full-Stack Developer') }}"
                               placeholder="Full-Stack Developer">
                        <span class="form-hint">Contoh: Full-Stack Developer</span>
                    </div>
                    <div class="form-group" style="grid-column:2">
                        <label for="hero_role2">Role Badge 2 (Hero Home)</label>
                        <input type="text" id="hero_role2" name="hero_role2" class="form-control"
                               value="{{ old('hero_role2', $profil->hero_role2 ?? 'IT Student') }}"
                               placeholder="IT Student">
                        <span class="form-hint">Contoh: IT Student</span>
                    </div>
                    <div class="form-group full">
                        <label for="hero_status">Status Kerja (Badge Card Home)</label>
                        <input type="text" id="hero_status" name="hero_status" class="form-control"
                               value="{{ old('hero_status', $profil->hero_status ?? 'Available for work') }}"
                               placeholder="Available for work">
                        <span class="form-hint">Teks yang tampil di kartu badge bawah kanan Home. Contoh: Available for work, Open to collaborate, dll.</span>
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
                        <div style="margin-bottom:0.75rem;padding:0.75rem 1rem;background:rgba(255,143,192,0.16);border-radius:10px;border:1.5px solid rgba(255,181,215,0.35);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
                            <span style="font-size:0.9rem;color:var(--text);font-weight:600;">
                                <i class="fa-solid fa-file-pdf" style="color:var(--danger);"></i> {{ basename($profil->cv_file) }}
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
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>

    <div style="margin-top:1.5rem;padding:1rem 1.25rem;background:rgba(255,181,215,0.16);border-radius:12px;border:1.5px solid rgba(255,181,215,0.35);font-size:0.85rem;color:var(--muted);">
        <i class="fa-solid fa-lightbulb" style="color:#f59e0b;"></i> <strong>Tips:</strong> Untuk mengelola ikon sosial media (Instagram, TikTok, Facebook), buka menu
        <a href="{{ route('admin.sosmed.index') }}" style="color:var(--accent);font-weight:700;">Sosial Media</a> di sidebar.
    </div>
</div>
@endsection
