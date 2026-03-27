@extends('admin.layouts.app')
@section('title', $item ? 'Edit Pengalaman' : 'Tambah Pengalaman')

@section('content')
<div style="max-width:680px;">
    <div class="card">
        <div class="card-header">
            <h2>{{ $item ? '✏️ Edit Pengalaman' : '➕ Tambah Pengalaman' }}</h2>
            <a href="{{ route('admin.pengalaman.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ $item ? route('admin.pengalaman.update', $item) : route('admin.pengalaman.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group full">
                        <label for="nama_organisasi">Nama Organisasi / Kegiatan <span style="color:var(--danger)">*</span></label>
                        <input type="text" id="nama_organisasi" name="nama_organisasi" class="form-control {{ $errors->has('nama_organisasi') ? 'is-invalid' : '' }}"
                               value="{{ old('nama_organisasi', $item?->nama_organisasi) }}"
                               placeholder="Contoh: BEM Universitas, Panitia Seminar IT, dll.">
                        @error('nama_organisasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group full">
                        <label for="peran">Peran / Jabatan <span style="color:var(--danger)">*</span></label>
                        <input type="text" id="peran" name="peran" class="form-control {{ $errors->has('peran') ? 'is-invalid' : '' }}"
                               value="{{ old('peran', $item?->peran) }}"
                               placeholder="Contoh: Ketua Divisi, Anggota, Staff IT, dll.">
                        @error('peran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis <span style="color:var(--danger)">*</span></label>
                        <select id="jenis" name="jenis" class="form-control {{ $errors->has('jenis') ? 'is-invalid' : '' }}">
                            @foreach(['organisasi' => '🏛️ Organisasi', 'kepanitiaan' => '📋 Kepanitiaan', 'komunitas' => '👥 Komunitas', 'magang' => '💼 Magang', 'volunteer' => '🤝 Volunteer', 'lainnya' => '📌 Lainnya'] as $val => $label)
                            <option value="{{ $val }}" {{ old('jenis', $item?->jenis) === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="urutan">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" class="form-control"
                               value="{{ old('urutan', $item?->urutan ?? 0) }}" min="0">
                        <span class="form-hint">Angka kecil tampil lebih dulu.</span>
                    </div>

                    <div class="form-group">
                        <label for="tahun_mulai">Tahun Mulai <span style="color:var(--danger)">*</span></label>
                        <input type="text" id="tahun_mulai" name="tahun_mulai" class="form-control {{ $errors->has('tahun_mulai') ? 'is-invalid' : '' }}"
                               value="{{ old('tahun_mulai', $item?->tahun_mulai) }}"
                               placeholder="2022">
                        @error('tahun_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tahun_selesai">Tahun Selesai</label>
                        <input type="text" id="tahun_selesai" name="tahun_selesai" class="form-control"
                               value="{{ old('tahun_selesai', $item?->tahun_selesai) }}"
                               placeholder="2023 atau kosongkan jika masih aktif">
                        <span class="form-hint">Kosongkan jika masih aktif (akan tampil "Sekarang").</span>
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi">Deskripsi <span style="font-weight:400;color:var(--faint)">(opsional)</span></label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control"
                                  rows="3" placeholder="Deskripsikan kegiatan, tanggung jawab, atau pencapaian...">{{ old('deskripsi', $item?->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 {{ $item ? 'Update Pengalaman' : 'Simpan Pengalaman' }}</button>
                    <a href="{{ route('admin.pengalaman.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
