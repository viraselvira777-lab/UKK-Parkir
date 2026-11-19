<?php 
 
namespace App\Http\Controllers\Owner; 
 
use App\Http\Controllers\Controller; 
use App\Models\Transaksi; 
use Illuminate\Http\Request; 
 
class RekapController extends Controller 
{ 
    public function index(Request $request) 
    { 

    $dari=$request->dari;
    $sampai=$request->sampai;
    
        $query = Transaksi::with(['kendaraan', 'area'])->where('status', 'keluar'); 
 
        // Filter berdasarkan rentang tanggal jika diisi 
        if ($request->filled('dari') && $request->filled('sampai')) { 
            $query->whereBetween('waktu_keluar', [ 
                $request->dari . ' 00:00:00', 
                $request->sampai . ' 23:59:59', 
            ]); 
        } 
 
        $transaksis = $query->latest('waktu_keluar')->paginate(15)->withQueryString(); 
        $totalPendapatan = (clone $query)->sum('biaya_total'); 
 
        return view('owner.rekap.index', compact('transaksis', 'totalPendapatan')); 
    } 
}