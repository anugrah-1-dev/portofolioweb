@extends('admin.layouts.app')
@section('title', $item ? 'Edit Jurnal' : 'Tambah Jurnal')

@section('content')
<div style="max-width:720px;">
    <div class="card">
        <div class="card-header">
            <h2>{{ $item ? '✏️ Edit Jurnal' : '➕ Tambah Jurnal' }}</h2>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ $item ? route('admin.jurnal.update', $item) : route('admin.jurnal.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group">
                        <label for="year">Tahun Terbit</label>
                        <input type="text" id="year" name="year" class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}"
                               value="{{ old('year', $item?->year) }}" placeholder="2024" maxlength="4">
                        @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="title">Judul Jurnal / Artikel</label>
                        <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                               value="{{ old('title', $item?->title) }}" placeholder="Judul lengkap jurnal atau artikel">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="authors">Penulis</label>
                        <input type="text" id="authors" name="authors" class="form-control {{ $errors->has('authors') ? 'is-invalid' : '' }}"
                               value="{{ old('authors', $item?->authors) }}" placeholder="Nama Penulis, Penulis Kedua, ...">
                        @error('authors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="journal_name">Nama Jurnal / Prosiding</label>
                        <input type="text" id="journal_name" name="journal_name" class="form-control {{ $errors->has('journal_name') ? 'is-invalid' : '' }}"
                               value="{{ old('journal_name', $item?->journal_name) }}" placeholder="Jurnal Teknologi Informasi, ...">
                        @error('journal_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="indexed_by">Diindeks Oleh</label>
                        <select id="indexed_by" name="indexed_by" class="form-control {{ $errors->has('indexed_by') ? 'is-invalid' : '' }}">
                            @foreach(['Sinta 1','Sinta 2','Sinta 3','Sinta 4','Sinta 5','Sinta 6','Scopus','IEEE','Springer','ACM','Google Scholar','DOAJ','Lainnya'] as $idx)
                            <option value="{{ $idx }}" {{ old('indexed_by', $item?->indexed_by) === $idx ? 'selected' : '' }}>{{ $idx }}</option>
                            @endforeach
                        </select>
                        @error('indexed_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="url">Link Jurnal (URL)</label>
                        <input type="url" id="url" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
                               value="{{ old('url', $item?->url) }}" placeholder="https://sinta.kemdikbud.go.id/...">
                        <span class="form-hint">Link ke Sinta, Scopus, IEEE, atau portal jurnal lainnya.</span>
                        @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="description">Abstrak / Deskripsi Singkat <span style="font-weight:400;color:var(--faint)">(opsional)</span></label>
                        <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Tuliskan abstrak atau ringkasan singkat...">{{ old('description', $item?->description) }}</textarea>
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
                        {{ $item ? '💾 Simpan Perubahan' : '✅ Tambah Jurnal' }}
                    </button>
                    <a href="{{ route('admin.jurnal.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
