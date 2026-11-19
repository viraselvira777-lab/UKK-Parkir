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
<h3>Data Kendaraan</h3> 
<a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary mb-3">+ Tambah Kendaraan</a> 
 
<table class="table table-bordered table-striped"> 
    <thead> 
        <tr> 
            <th>Id</th> 
            <th>Plat Nomor</th> 
            <th>Jenis Kendaraan</th> 
            <th>Warna</th> 
            <th>Pemilik</th> 
            <th>Aksi</th> 
            
        </tr> 
    </thead> 
    <tbody> 
        @foreach($kendaraans as $i => $kendaraan) 
        <tr> 
            <td>{{ $kendaraans->firstItem() + $i }}</td>
             <td>{{ $kendaraan->plat_nomor }}</td> 
            <td>{{ $kendaraan->jenis_kendaraan }}</td> 
            <td>{{ $kendaraan->warna }}</td> 
            <td>{{ $kendaraan->pemilik }}</td> 
            <td>
                <a href="{{ route('admin.kendaraan.edit', $kendaraan->id_kendaraan) }}" class="btn btn-sm btn
warning">Edit</a> 
                <form action="{{ route('admin.kendaraan.destroy', $kendaraan->id_kendaraan) }}" method="POST" 
class="d-inline" 
                      onsubmit="return confirm('Yakin hapus kendaraan ini?')"> 
                    @csrf @method('DELETE') 
                    <button class="btn btn-sm btn-danger">Hapus</button> 
                </form> 
            </td> 
        </tr> 
        @endforeach 
    </tbody> 
</table> 
 
{{ $kendaraans->links() }} 
@endsection