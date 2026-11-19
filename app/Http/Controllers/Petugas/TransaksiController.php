<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Kendaraan;
use App\Models\Tarif;
use App\Models\AreaParkir;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // Daftar kendaraan yang sedang parkir
   public function index()
{
    $transaksiAktif = \App\Models\Transaksi::with(['kendaraan', 'tarif'])
        ->whereNull('waktu_keluar')
        ->latest()
        ->paginate(10);

    return view('petugas.transaksi.index', compact('transaksiAktif'));
}

    // Form kendaraan masuk
    public function formMasuk()
{
    $kendaraan = Kendaraan::orderBy('plat_nomor', 'asc')->get();

    $tarifs = Tarif::orderBy('id_tarif', 'asc')->get();

    $areas = AreaParkir::whereColumn('terisi', '<', 'kapasitas')->get();

    return view('petugas.transaksi.form-masuk', compact(
        'kendaraan',
        'tarifs',
        'areas'
    ));
}

    // Proses simpan kendaraan masuk
    public function prosesMasuk(Request $request)
    {
        $request->validate([
            'id_kendaraan' => 'required|exists:tb_kendaraan,id_kendaraan',
            'id_area' => 'required|exists:tb_area_parkir,id_area',
        ]);

        // Tarif ditentukan dari jenis kendaraan di database, bukan pilihan petugas.
        $kendaraan = Kendaraan::findOrFail($request->id_kendaraan);
        $tarif = Tarif::where('jenis_kendaraan', $kendaraan->jenis_kendaraan)
            ->orderByDesc('id_tarif')
            ->first();

        if (!$tarif) {
            return back()->withInput()->with('error',
                'Tarif untuk jenis kendaraan ' . $kendaraan->jenis_kendaraan . ' belum diatur oleh admin.');
        }

        $area = AreaParkir::findOrFail($request->id_area);

        if ($area->terisi >= $area->kapasitas) {
            return back()->with('error', 'Area parkir sudah penuh.');
        }

        Transaksi::create([
            'id_kendaraan' => $request->id_kendaraan,
            'waktu_masuk' => now(),
            'id_tarif' => $tarif->id_tarif,
            'status' => 'masuk',
            'id_user' => auth()->id(),
            'id_area' => $request->id_area,
        ]);

        // Tambah jumlah kendaraan terisi di area
        $area->increment('terisi');

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Mencatat kendaraan masuk',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route('petugas.transaksi.index')
            ->with('success', 'Kendaraan berhasil dicatat masuk.');
    }

    // Form kendaraan keluar
    public function formKeluar($id)
    {
        $transaksi = Transaksi::with(['kendaraan', 'tarif', 'area'])
            ->findOrFail($id);

        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $waktuSekarang = now();

        // Durasi dibulatkan ke atas, minimal 1 jam
        $durasiJam = max(1, ceil(
            $waktuMasuk->diffInMinutes($waktuSekarang) / 60
        ));

        $biaya = $durasiJam * $transaksi->tarif->tarif_per_jam;

        return view('petugas.transaksi.form-keluar', compact(
            'transaksi',
            'durasiJam',
            'biaya'
        ));
    }

    // Proses kendaraan keluar
    public function prosesKeluar(Request $request, $id)
    {
        $transaksi = Transaksi::with('tarif')->findOrFail($id);

        $waktuMasuk = Carbon::parse($transaksi->waktu_masuk);
        $waktuKeluar = now();

        $durasiJam = max(1, ceil(
            $waktuMasuk->diffInMinutes($waktuKeluar) / 60
        ));

        $biaya = $durasiJam * $transaksi->tarif->tarif_per_jam;

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'durasi_jam' => $durasiJam,
            'biaya_total' => $biaya,
            'status' => 'keluar',
        ]);

        // Kurangi jumlah kendaraan terisi di area
        $transaksi->area->decrement('terisi');

        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => 'Mencatat kendaraan keluar',
            'waktu_aktivitas' => now(),
        ]);

        return redirect()->route(
            'petugas.transaksi.struk',
            $transaksi->id_transaksi
        );
    }

    // Halaman cetak struk
    public function cetakStruk($id)
    {
        $transaksi = Transaksi::with([
            'kendaraan',
            'tarif',
            'area',
            'petugas'
        ])->findOrFail($id);

        return view('petugas.transaksi.struk', compact('transaksi'));
    }
}
