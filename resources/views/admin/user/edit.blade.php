@extends('layouts.app') 
@section('content') 
<h3>Edit User</h3> 
 
<form method="POST" action="{{ route('admin.user.update', $user->id_user) }}"> 
    @csrf @method('PUT') 
    <div class="mb-3"> 
        <label>Nama Lengkap</label> 
        <input type="text" name="nama_lengkap" class="form-control" value="{{ $user
->nama_lengkap }}" required> 
    </div> 
    <div class="mb-3"> 
        <label>Username</label> 
        <input type="text" name="username" class="form-control" value="{{ $user->username 
}}" required> 
    </div> 
    <div class="mb-3"> 
        <label>Password Baru (kosongkan jika tidak diganti)</label> 
        <input type="password" name="password" class="form-control"> 
    </div> 
    <div class="mb-3"> 
        <label>Role</label> 
        <select name="role" class="form-select" required> 
            <option value="admin" @selected($user->role=='admin')>Admin</option> 
            <option value="petugas" @selected($user->role=='petugas')>Petugas</option> 
            <option value="owner" @selected($user->role=='owner')>Owner</option> 
        </select> 
    </div> 
    <div class="mb-3"> 
        <label>Status</label> 
        <select name="status_aktif" class="form-select" required> 
            <option value="1" @selected($user->status_aktif==1)>Aktif</option> 
            <option value="0" @selected($user->status_aktif==0)>Nonaktif</option> 
        </select> 
    </div> 
    <button class="btn btn-primary">Update</button> 
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection