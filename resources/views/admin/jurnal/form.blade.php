@extends('admin.layouts.app')
@section('title', $item ? 'Edit Lisensi' : 'Tambah Lisensi')

@push('styles')
<style>
    .jurnal-form-wrap { max-width: 720px; }
    .jurnal-form-wrap .form-label-optional { font-weight: 400; color: var(--faint); }
    .file-preview { margin-top: 0.6rem; }
    .file-preview img { max-width: 200px; max-height: 160px; border-radius: 8px; border: 1px solid var(--border); }
    .file-preview .pdf-badge { display:inline-flex; align-items:center; gap:0.4rem; background:rgba(255,100,100,0.15); color:#ff6464; padding:0.4rem 0.8rem; border-radius:6px; font-size:0.85rem; font-weight:600; }
    .hapus-check { display:flex; align-items:center; gap:0.5rem; margin-top:0.5rem; font-size:0.85rem; color:var(--faint); cursor:pointer; }
</style>
@endpush

@section('content')
<div class="jurnal-form-wrap">
    <div class="card">
        <div class="card-header">
            <h2>
                @if($item)<i class="fa-solid fa-pen"></i> Edit Lisensi
                @else<i class="fa-solid fa-plus"></i> Tambah Lisensi
                @endif
            </h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ $item ? route('admin.jurnal.update', $item) : route('admin.jurnal.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label for="year">Tahun Terbit <span class="form-label-required">*</span></label>
                        <input type="text" id="year" name="year" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}"
                               value="{{ old('year', $item?->year) }}" placeholder="2024" maxlength="4">
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="title">Judul Lisensi / Sertifikasi <span class="form-label-required">*</span></label>
                        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $item?->title) }}" placeholder="Nama lengkap lisensi atau sertifikasi">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="journal_name">Penerbit / Lembaga Sertifikasi <span class="form-label-required">*</span></label>
                        <input type="text" id="journal_name" name="journal_name" class="form-control {{ $errors->has('journal_name') ? 'is-invalid' : '' }}"
                               value="{{ old('journal_name', $item?->journal_name) }}" placeholder="Google, Microsoft, Cisco, Coursera, ...">
                        @error('journal_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="authors">Pemegang Sertifikat <span class="form-label-optional">(opsional)</span></label>
                        <input type="text" id="authors" name="authors" class="form-control {{ $errors->has('authors') ? 'is-invalid' : '' }}"
                               value="{{ old('authors', $item?->authors) }}" placeholder="Nama pemegang sertifikat">
                        @error('authors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="indexed_by">Credential ID / Level <span class="form-label-optional">(opsional)</span></label>
                        <input type="text" id="indexed_by" name="indexed_by" class="form-control {{ $errors->has('indexed_by') ? 'is-invalid' : '' }}"
                               value="{{ old('indexed_by', $item?->indexed_by) }}" placeholder="Associate, Professional, A1, ...">
                        @error('indexed_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="file_sertifikat">File Sertifikat <span class="form-label-optional">(gambar atau PDF, maks 10MB)</span></label>
                        <input type="file" id="file_sertifikat" name="file_sertifikat"
                               class="form-control {{ $errors->has('file_sertifikat') ? 'is-invalid' : '' }}"
                               accept="image/jpg,image/jpeg,image/png,image/webp,application/pdf">
                        @error('file_sertifikat') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        @if($item?->file_sertifikat)
                        <div class="file-preview" id="currentFilePreview">
                            @php $ext = strtolower(pathinfo($item->file_sertifikat, PATHINFO_EXTENSION)); @endphp
                            @if(in_array($ext, ['jpg','jpeg','png','webp']))
                                <img src="{{ \App\Support\MediaUrl::from($item->file_sertifikat) }}" alt="Sertifikat">
                            @else
                                <span class="pdf-badge"><i class="fa-solid fa-file-pdf"></i> {{ basename($item->file_sertifikat) }}</span>
                            @endif
                            <label class="hapus-check">
                                <input type="checkbox" name="hapus_file" value="1"> Hapus file ini
                            </label>
                        </div>
                        @endif
                    </div>
                    <div class="form-group full">
                        <label for="description">Deskripsi Singkat <span class="form-label-optional">(opsional)</span></label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Tuliskan deskripsi singkat tentang lisensi ini...">{{ old('description', $item?->description) }}</textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                        {!! $item ? '<i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan' : '<i class="fa-solid fa-plus"></i> Tambah Lisensi' !!}
                    </button>
                    <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection