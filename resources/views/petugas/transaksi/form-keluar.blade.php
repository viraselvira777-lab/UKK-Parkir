@extends('layouts.app') 
@section('content') 
<h3>Kendaraan Keluar</h3> 
 
<table class="table table-bordered w-50"> 
    <tr><th>Plat Nomor</th><td>{{ $transaksi->kendaraan->plat_nomor }}</td></tr> 
    <tr><th>Waktu Masuk</th><td>{{ \Carbon\Carbon::parse($transaksi->waktu_masuk)
->format('d-m-Y H:i') }}</td></tr> 
    <tr><th>Durasi</th><td>{{ $durasiJam }} jam</td></tr> 
    <tr><th>Total Biaya</th><td><strong>Rp{{ number_format($biaya) }}</strong></td></tr> 
</table> 
<form method="POST" action="{{ route('petugas.transaksi.prosesKeluar', $transaksi
->id_transaksi) }}"> 
    @csrf 
    <button class="btn btn-success">Konfirmasi & Cetak Struk</button> 
  <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary">Batal</a> 
</form> 
@endsection 