@extends('admin.layouts.app')
@section('title', $item ? 'Edit Sosial Media' : 'Tambah Sosial Media')

@section('content')
<div style="max-width:560px;">
    <div class="card">
        <div class="card-header">
            <h2>{{ $item ? '✏️ Edit Sosial Media' : '➕ Tambah Sosial Media' }}</h2>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ $item ? route('admin.sosmed.update', $item) : route('admin.sosmed.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group full">
                        <label for="platform">Platform</label>
                        <select id="platform" name="platform" class="form-control {{ $errors->has('platform') ? 'is-invalid' : '' }}">
                            @foreach([
                                'instagram' => '📸 Instagram',
                                'tiktok'    => '🎵 TikTok',
                                'facebook'  => '📘 Facebook',
                                'twitter'   => '🐦 Twitter / X',
                                'youtube'   => '📺 YouTube',
                                'linkedin'  => '💼 LinkedIn',
                                'github'    => '🐙 GitHub',
                                'whatsapp'  => '💬 WhatsApp',
                            ] as $val => $label)
                            <option value="{{ $val }}" {{ old('platform', $item?->platform) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                        @error('platform') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="label">Label Tampil</label>
                        <input type="text" id="label" name="label" class="form-control {{ $errors->has('label') ? 'is-invalid' : '' }}"
                               value="{{ old('label', $item?->label) }}" placeholder="Instagram, TikTok, ...">
                        <span class="form-hint">Nama yang ditampilkan saat hover di ikon.</span>
                        @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group full">
                        <label for="url">URL Profil</label>
                        <input type="url" id="url" name="url" class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}"
                               value="{{ old('url', $item?->url) }}" placeholder="https://instagram.com/username">
                        @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="urutan">Urutan</label>
                        <input type="number" id="urutan" name="urutan" class="form-control"
                               value="{{ old('urutan', $item?->urutan ?? 0) }}" min="0">
                        <span class="form-hint">Angka lebih kecil tampil lebih dulu.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        {{ $item ? '💾 Simpan Perubahan' : '✅ Tambah' }}
                    </button>
                    <a href="{{ route('admin.sosmed.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
