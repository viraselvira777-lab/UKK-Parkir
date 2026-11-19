@extends('layouts.app') 
@section('content') 
<h3>Kendaraan Sedang Parkir</h3> 
<a href="{{ route('petugas.transaksi.formMasuk') }}" class="btn btn-primary mb-3">+ Catat 
Masuk</a> 
 
<table class="table table-bordered"> 
    <thead> 
        <tr><th>Plat Nomor</th><th>Area</th><th>Waktu Masuk</th><th>Aksi</th></tr> 
    </thead> 
    <tbody> 
        @foreach($transaksiAktif as $t) 
        <tr> 
            <td>{{ $t->kendaraan->plat_nomor }}</td> 
            <td>{{ $t->area->nama_area }}</td> 
            <td>{{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d-m-Y H:i') }}</td> 
            <td><a href="{{ route('petugas.transaksi.formKeluar', $t->id_transaksi) }}" class="btn btn-sm btn-warning">Proses Keluar</a></td> 
        </tr> 
        @endforeach 
    </tbody> 
</table> 
@endsection 