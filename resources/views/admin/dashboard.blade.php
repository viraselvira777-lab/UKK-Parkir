@extends('layouts.app')
@section('title','Dashboard Admin')

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
    Kelola Data User, Tarif Parkir, Area Parkir, Kendaraan, dan Pantau Aktivitas Terbaru dengan mudah.
</p>
</div>
</div>
</div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card bg-white text-black shadow-sm">
            <div class="card-body">
                <h5 class="caed-title">Tarif Parkir</h5>
                <p class="card-text fs-4 fe-bold">{{\App\Models\Tarif::count()}}</p>
</div>
</div>
</div>
<div class="col-md-3 mb-3">
    <div class="card bg-white text-black shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Area Parkir</h5>
            <p class="card-text fs-4 fw-bold">{{\App\Models\AreaParkir::count()}}</p>
            
</div>
</div>
</div>
<div class="col-md-3 mb-3">
    <div class="card bg-white text-black shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Kendaraan</h5>
            <p class="card-text fs-4 fw-bold">{{\App\Models\Kendaraan::count()}}</p>
            
</div>
</div>
</div>

@endsection




