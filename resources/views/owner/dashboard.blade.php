@extends('layouts.app')
@section('title','Dashboard Owner')

@section('content')

<div class="card border-0 shadow-sm bg-white text-black mb-4">
    <div class="card-body p-4">
        <div class="row align-items-center">
            <div class="col-md-8">

<h2 class="fw-bold mb-2">
    Selamat Datang
    {{auth()->user()->nama_lengkap}}!
</h2>

<p class="mb-0">
    Kelola Rekap Transaksi Parkir, Pantau Pendapatan , dan Lihat Aktivitas Terbaru dengan Mudah.
</div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card bg-white text-black shadow-sm">
            <div class="card-body">
                <h5 class="caed-title">Rekap Transaksi</h5>


@endsection




