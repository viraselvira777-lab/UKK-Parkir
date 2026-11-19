@extends('layouts.app') 
@section('content') 
<h3>Tambah Tarif</h3> 
 
<form method="POST" action="{{ route('admin.tarif.store') }}"> 
    @csrf 
    <div class="mb-3"> 
        <label>Jenis Kendaraan</label> 
        <select name="jenis_kendaraan" class="form-select" required> 
            <option value="motor">Motor</option> 
            <option value="mobil">Mobil</option> 
            <option value="lainnya">Lainnya</option> 
        </select> 
    </div> 

    
    <div class="mb-3">
        <label>Tarif Per Jam </label>
        <input type="number" name="tarif_per_jam" class="form-control" required>
</div>
    <button class="btn btn-primary">Simpan</button> 
      <a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection
