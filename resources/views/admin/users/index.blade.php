@extends('admin.layouts.app')
@section('title', 'Manajemen User')

@section('content')
<div class="card">
    <div class="card-header">
        <h2><i class="fa-solid fa-users" style="color:var(--primary2);font-size:0.95rem;"></i> Daftar User Login</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah User</a>
    </div>
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th style="width:220px;">Email</th>
                    <th style="width:180px;">Dibuat</th>
                    <th style="width:130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>
                        <div class="td-title">{{ $user->name }}</div>
                        @if($user->id === auth()->id())
                        <div class="td-sub" style="color:var(--primary);">Anda saat ini</div>
                        @endif
                    </td>
                    <td><span style="font-size:0.9rem;color:var(--muted);">{{ $user->email }}</span></td>
                    <td><span style="font-size:0.85rem;color:var(--faint);">{{ $user->created_at->format('d M Y, H:i') }}</span></td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn-sm btn-edit"><i class="fa-solid fa-pen"></i> Edit</a>
                            @if($user->id !== auth()->id())
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                  onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del"><i class="fa-solid fa-trash"></i></button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-users"></i></div>
                            <p>Belum ada user. <a href="{{ route('admin.users.create') }}" style="color:var(--primary);font-weight:700;">Tambah sekarang</a></p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div style="padding:1.25rem 1.5rem;border-top:1.5px solid var(--border);display:flex;justify-content:flex-end;">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
