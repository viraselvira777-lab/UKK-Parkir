@extends('layouts.app') 
@section('content') 
<h3>Tambah User</h3> 
 
<form method="POST" action="{{ route('admin.user.store') }}"> 
    @csrf 
    <div class="mb-3"> 
        <label>Nama Lengkap</label> 
        <input type="text" name="nama_lengkap" class="form-control" required> 
    </div> 
    <div class="mb-3"> 
        <label>Username</label> 
        <input type="text" name="username" class="form-control" required> 
    </div> 
    <div class="mb-3"> 
        <label>Password</label> 
        <input type="password" name="password" class="form-control" required> 
    </div> 
    <div class="mb-3"> 
        <label>Role</label> 
        <select name="role" class="form-select" required> 
            <option value="admin">Admin</option> 
            <option value="petugas">Petugas</option> 
            <option value="owner">Owner</option> 
        </select> 
    </div> 
    <button class="btn btn-primary">Simpan</button> 
      <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection
