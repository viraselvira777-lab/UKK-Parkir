@extends('layouts.app') 
@section('content') 

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h3>Data User</h3> 
<a href="{{ route('admin.user.create') }}" class="btn btn-primary mb-3">+ Tambah User</a> 
 
<table class="table table-bordered table-striped"> 
    <thead> 
        <tr> 
            <th>id</th> 
            <th>Nama Lengkap</th> 
            <th>Username</th> 
            <th>Role</th> 
            <th>Status</th> 
            <th>Aksi</th> 
        </tr> 
    </thead> 
    <tbody> 
        @foreach($users as $i => $user) 
        <tr> 
            <td>{{ $users->firstItem() + $i }}</td>
             <td>{{ $user->nama_lengkap }}</td> 
            <td>{{ $user->username }}</td> 
            <td><span class="badge bg-info">{{ $user->role }}</span></td> 
            <td>{{ $user->status_aktif ? 'Aktif' : 'Nonaktif' }}</td> 
            <td> 
                <a href="{{ route('admin.user.edit', $user->id_user) }}"
                 class="btn btn-sm btn
warning">Edit</a> 
                <form action="{{ route('admin.user.destroy', $user->id_user) }}" 
                method="POST" 
class="d-inline" 
                      onsubmit="return confirm('Yakin hapus user ini?')"> 
                    @csrf @method('DELETE') 
                    <button class="btn btn-sm btn-danger">Hapus</button> 
                </form> 
            </td> 
        </tr> 
        @endforeach 
    </tbody> 
</table> 
 
{{ $users->links() }} 
@endsection