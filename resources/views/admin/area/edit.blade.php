@extends('layouts.app') 
@section('content') 
<h3>Edit Area</h3> 
 
<form method="POST" action="{{ route('admin.area.update', $area->id_area) }}"> 
    @csrf @method('PUT') 
    <div class="mb-3"> 
        <label>Nama Area</label> 
        <input type="text" name="nama_area" class="form-control" value="{{ $area
->nama_area }}" required> 
    </div> 
    <div class="mb-3"> 
        <label>Kapasitas</label> 
        <input type="number" name="kapasitas" class="form-control" value="{{ $area->kapasitas 
}}" required>
    </div> 
  
    <button class="btn btn-primary">Update</button> 
    <a href="{{ route('admin.area.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection