@extends('layouts.app') 
@section('content') 
<h3>Rekap Transaksi</h3> 
 
<form method="GET" class="row g-2 mb-3"> 
    <div class="col-auto"> 
        <input type="date" name="dari" value="{{ request('dari') }}" class="form-control"> 
    </div> 
    <div class="col-auto"> 
        <input type="date" name="sampai" value="{{ request('sampai') }}" class="form-control"> 
    </div> 
      <div class="col-auto"> 
        <button class="btn btn-primary">Filter</button> 
    </div> 
</form> 
 
<div class="alert alert-info"> 
    Total Pendapatan: <strong>Rp{{ number_format($totalPendapatan) }}</strong> 
</div> 
 
<table class="table table-bordered"> 
    <thead> 
        <tr><th>Plat 
Nomor</th><th>Area</th><th>Masuk</th><th>Keluar</th><th>Durasi</th><th>Biaya</th>
</tr> 
    </thead> 
    <tbody> 
        @foreach($transaksis as $t) 
        <tr> 
            <td>{{ $t->kendaraan->plat_nomor }}</td> 
            <td>{{ $t->area->nama_area }}</td> 
            <td>{{ \Carbon\Carbon::parse($t->waktu_masuk)->format('d-m-Y H:i') }}</td> 
            <td>{{ \Carbon\Carbon::parse($t->waktu_keluar)->format('d-m-Y H:i') }}</td> 
            <td>{{ $t->durasi_jam }} jam</td> 
            <td>Rp{{ number_format($t->biaya_total) }}</td> 
        </tr> 
        @endforeach 
    </tbody> 
</table> 
{{ $transaksis->links() }} 
@endsection
