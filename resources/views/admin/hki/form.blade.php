@extends('admin.layouts.app')
@section('title', $action === 'edit' ? 'Edit HKI' : 'Tambah HKI')

@push('styles')
<style>
    .hki-form-wrap { max-width: 720px; }
    .hki-form-wrap .form-label-optional { font-weight: 400; color: var(--faint); }
</style>
@endpush

@section('content')
<div class="hki-form-wrap">
    <div class="card">
        <div class="card-header">
            <h2>
                @if($action === 'edit')<i class="fa-solid fa-pen"></i> Edit HKI
                @else<i class="fa-solid fa-plus"></i> Tambah HKI
                @endif
            </h2>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ $action === 'edit' ? route('admin.hki.update', $hki) : route('admin.hki.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if($action === 'edit') @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label for="year">Tahun</label>
                        <input type="text" id="year" name="year" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}"
                               value="{{ old('year', $hki->year) }}" placeholder="2024" maxlength="4">
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_hki">Jenis HKI</label>
                        <select id="jenis_hki" name="jenis_hki" class="form-control {{ $errors->has('jenis_hki') ? 'is-invalid' : '' }}">
                            @foreach(['Hak Cipta','Paten','Paten Sederhana','Merek','Desain Industri','Rahasia Dagang','Indikasi Geografis','Lainnya'] as $jenis)
                            <option value="{{ $jenis }}" {{ old('jenis_hki', $hki->jenis_hki) === $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                            @endforeach
                        </select>
                        @error('jenis_hki') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="title">Judul</label>
                        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $hki->title) }}" placeholder="Judul lengkap HKI">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="authors">Penulis / Pemegang Hak</label>
                        <input type="text" id="authors" name="authors" class="form-control {{ $errors->has('authors') ? 'is-invalid' : '' }}"
                               value="{{ old('authors', $hki->authors) }}" placeholder="Nama Pencipta, Pencipta Kedua, ...">
                        @error('authors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="nomor_pencatatan">Nomor Pencatatan / Sertifikat <span class="form-label-optional">(opsional)</span></label>
                        <input type="text" id="nomor_pencatatan" name="nomor_pencatatan" class="form-control {{ $errors->has('nomor_pencatatan') ? 'is-invalid' : '' }}"
                               value="{{ old('nomor_pencatatan', $hki->nomor_pencatatan) }}" placeholder="EC00202xxxxxx">
                        @error('nomor_pencatatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="sertifikat_file">File Sertifikat / Dokumen <span class="form-label-optional">(opsional)</span></label>
                        @if($action === 'edit' && $hki->sertifikat_file)
                        <div style="margin-bottom:0.75rem;padding:0.75rem 1rem;background:rgba(255,181,215,0.16);border-radius:10px;border:1.5px solid rgba(255,181,215,0.35);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;">
                            @php $ext = strtolower(pathinfo($hki->sertifikat_file, PATHINFO_EXTENSION)); @endphp
                            <span style="font-size:0.9rem;color:var(--text);font-weight:600;">
                                <i class="fa-solid fa-{{ in_array($ext, ['jpg','jpeg','png','webp']) ? 'image' : 'file-pdf' }}" style="color:{{ in_array($ext, ['jpg','jpeg','png','webp']) ? 'var(--accent)' : '#dc2626' }};"></i>
                                {{ basename($hki->sertifikat_file) }}
                            </span>
                            <div style="display:flex;gap:0.75rem;align-items:center;">
                                <a href="{{ Storage::url($hki->sertifikat_file) }}" target="_blank"
                                   style="font-size:0.85rem;color:var(--accent);font-weight:700;text-decoration:none;">&#128279; Lihat File</a>
                                <label style="font-size:0.85rem;color:#dc2626;cursor:pointer;font-weight:600;">
                                    <input type="checkbox" name="hapus_sertifikat" value="1"> Hapus File
                                </label>
                            </div>
                        </div>
                        @endif
                        <input type="file" id="sertifikat_file" name="sertifikat_file" class="form-control {{ $errors->has('sertifikat_file') ? 'is-invalid' : '' }}"
                               accept=".pdf,.jpg,.jpeg,.png,.webp">
                        <span class="form-hint">Format: PDF, JPG, PNG, WEBP. Maks: 5MB. File sertifikat HKI atau dokumen pendaftaran.</span>
                        @error('sertifikat_file') <div class="invalid-feedback" style="display:block">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="description">Deskripsi <span class="form-label-optional">(opsional)</span></label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Tuliskan deskripsi singkat tentang HKI ini...">{{ old('description', $hki->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="urutan">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" class="form-control"
                               value="{{ old('urutan', $hki->urutan ?? 0) }}" min="0">
                        <span class="form-hint">Angka lebih kecil tampil lebih dulu.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        @if($action === 'edit')
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        @else
                        <i class="fa-solid fa-plus"></i> Tambah HKI
                        @endif
                    </button>
                    <a href="{{ route('admin.hki.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
