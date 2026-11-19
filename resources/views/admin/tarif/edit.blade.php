@extends('layouts.app') 
@section('content') 
<h3>Edit Tarif</h3> 
 
<form method="POST" action="{{ route('admin.tarif.update', $tarif->id_tarif) }}"> 
    @csrf @method('PUT') 
   <div class="mb-3"> 
        <label>Jenis Kendaraan</label> 
        <select name="jenis_kendaraan" class="form-select" required> 
            <option value="motor">Motor</option> 
            <option value="mobil">Mobil</option> 
            <option value="lainnya">Lainnya</option> 
        </select> 
    </div>
    <div class="mb-3"> 
        <label>Tarif Per Jam</label> 
      <input type="number" name="tarif_per_jam" class="form-control" value="{{ $tarif->tarif_per_jam}}" required> 
    </div> 

    <button class="btn btn-primary">Update</button> 
    <a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection