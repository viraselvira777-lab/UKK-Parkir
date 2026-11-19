<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\Kendaraan; 
use Illuminate\Http\Request; 
 
class KendaraanController extends Controller 
{ 
    public function index() { 
    $kendaraans = Kendaraan::latest()->paginate(10); 
    return view('admin.kendaraan.index', compact('kendaraans')); 
   } 

   public function create()
   {
    return view('admin.kendaraan.create');
   }

   public function store(Request $request) { 
    $request->validate([ 
        'plat_nomor' => 'required|string|max:15', 
        'jenis_kendaraan' => 'required|string', 
        'pemilik' => 'required|string', 
    ]); 
    Kendaraan::create([ 
        'plat_nomor' => $request->plat_nomor, 
        'jenis_kendaraan' => $request->jenis_kendaraan, 
        'warna' => $request->warna, 
        'pemilik' => $request->pemilik, 
        'id_user' => auth()->id(), 
    ]); 
    return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan 
ditambahkan.'); 
} 
 

 
    public function edit(Kendaraan $kendaraan) 
    { 
        return view('admin.kendaraan.edit', compact('kendaraan')); 
    }
     public function update(Request $request, Kendaraan $kendaraan) 
    { 
        $request->validate([ 
        'plat_nomor' => 'required|string|max:15', 
        'jenis_kendaraan' => 'required|string', 
        'warna' => 'required|string', 
        'pemilik' => 'required|string', 
    ]); 
 
$data = $request->only('plat_nomor', 'jenis_kendaraan','warna','pemilik'); 
 
        $kendaraan->update($data); 
 
        return redirect()->route('admin.kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.'); 
    } 
 public function destroy($id)
{
    $kendaraan = \App\Models\Kendaraan::findOrFail($id);

    // Cek apakah kendaraan sudah digunakan transaksi
    $cekTransaksi = \App\Models\Transaksi::where(
        'id_kendaraan',
        $kendaraan->id_kendaraan
    )->exists();

    if ($cekTransaksi) {
        return redirect()->route('admin.kendaraan.index')
            ->with('error', 'Kendaraan tidak bisa dihapus karena sudah memiliki riwayat transaksi!');
    }

    $kendaraan->delete();

    return redirect()->route('admin.kendaraan.index')
        ->with('success', 'Kendaraan berhasil dihapus!');
}
} 