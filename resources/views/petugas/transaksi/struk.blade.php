<!DOCTYPE html> 
<html lang="id"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Struk Parkir</title> 
    <style> 
        body { font-family: monospace; width: 280px; margin: 20px auto; } 
        hr { border-top: 1px dashed #000; } 
        .center { text-align: center; } 
        table { width: 100%; } 
        @media print { 
            .no-print { display: none; } 
        } 
    </style> 
</head> 
<body> 
    <div class="center"> 
        <h4>STRUK PARKIR</h4> 
        <p>{{ $transaksi->area->nama_area }}</p> 
    </div> 
    <hr> 
    <table> 
        <tr><td>Plat Nomor</td><td>: {{ $transaksi->kendaraan->plat_nomor }}</td></tr> 
        <tr><td>Jenis</td><td>: {{ $transaksi->kendaraan->jenis_kendaraan }}</td></tr> 
        <tr><td>Masuk</td><td>: {{ \Carbon\Carbon::parse($transaksi->waktu_masuk)
->format('d-m-Y H:i') }}</td></tr> 
        <tr><td>Keluar</td><td>: {{ \Carbon\Carbon::parse($transaksi->waktu_keluar)
->format('d-m-Y H:i') }}</td></tr> 
        <tr><td>Durasi</td><td>: {{ $transaksi->durasi_jam }} jam</td></tr> 
        <tr><td>Tarif/jam</td><td>: Rp{{ number_format($transaksi->tarif->tarif_per_jam) 
}}</td></tr> 
    </table> 
    <hr> 
    <div class="center"> 
        <strong>TOTAL: Rp{{ number_format($transaksi->biaya_total) }}</strong> 
    </div> 
    <hr> 
    <p class="center">Petugas: {{ $transaksi->petugas->nama_lengkap }}<br>Terima kasih</p> 
 
    <div class="no-print center"> 
        <button onclick="window.print()">Cetak</button>  
        <a href="{{ route('petugas.transaksi.index') }}" class="btn btn-secondary">Batal</a> 
    </div>
</body>
</html>