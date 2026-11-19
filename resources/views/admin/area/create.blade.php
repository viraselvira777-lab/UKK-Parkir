@extends('layouts.app') 
@section('content') 
<h3>Tambah Area</h3> 
 
<form method="POST" action="{{ route('admin.area.store') }}"> 
    @csrf 
    <div class="mb-3"> 
        <label>Nama Area</label> 
        <input type="text" name="nama_area" class="form-control" required> 
    </div> 
    <div class="mb-3"> 
        <label>Kapasitas</label> 
        <input type="number" name="kapasitas" class="form-control" required> 
    </div>  
    <button class="btn btn-primary">Simpan</button> 
      <a href="{{ route('admin.area.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection
