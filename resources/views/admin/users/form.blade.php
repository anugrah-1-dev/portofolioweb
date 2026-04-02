@extends('admin.layouts.app')
@section('title', $item ? 'Edit User' : 'Tambah User')

@section('content')
<div style="max-width:560px;">
    <div class="card">
        <div class="card-header">
            <h2>
                @if($item)<i class="fa-solid fa-pen"></i> Edit User
                @else<i class="fa-solid fa-plus"></i> Tambah User
                @endif
            </h2>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ $item ? route('admin.users.update', $item) : route('admin.users.store') }}">
                @csrf
                @if($item) @method('PUT') @endif

                <div class="form-grid">
                    <div class="form-group full">
                        <label for="name">Nama Lengkap <span style="color:var(--danger)">*</span></label>
                        <input type="text" id="name" name="name"
                               class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               value="{{ old('name', $item?->name) }}"
                               placeholder="Nama lengkap user" autocomplete="name">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group full">
                        <label for="email">Email <span style="color:var(--danger)">*</span></label>
                        <input type="email" id="email" name="email"
                               class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                               value="{{ old('email', $item?->email) }}"
                               placeholder="email@contoh.com" autocomplete="email">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group full">
                        <label for="password">
                            Password <span style="color:var(--danger)">*</span>
                            @if($item)
                            <span style="font-weight:400;color:var(--faint)">(kosongkan jika tidak ingin mengubah)</span>
                            @endif
                        </label>
                        <input type="password" id="password" name="password"
                               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="Minimal 8 karakter" autocomplete="new-password">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group full">
                        <label for="password_confirmation">Konfirmasi Password @if(!$item)<span style="color:var(--danger)">*</span>@endif</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password" autocomplete="new-password">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">{!! $item ? '<i class="fa-solid fa-floppy-disk"></i> Update User' : '<i class="fa-solid fa-plus"></i> Simpan User' !!}</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
