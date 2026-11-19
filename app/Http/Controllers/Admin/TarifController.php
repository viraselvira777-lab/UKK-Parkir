<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\Tarif; 
use Illuminate\Http\Request; 
 
class TarifController extends Controller 
{ 
    public function index() { 
    $tarifs = Tarif::latest()->paginate(10); 
    return view('admin.tarif.index', compact('tarifs')); 
   } 

   public function create()
   {
    return view('admin.tarif.create');
   }

   public function store(Request $request) { 
    $request->validate([ 
        'jenis_kendaraan' => 'required|in:motor,mobil,lainnya', 
        'tarif_per_jam' => 'required|numeric|min:0', 
    ]); 

    Tarif::create([
        'jenis_kendaraan'=>$request->jenis_kendaraan,
        'tarif_per_jam'=>$request->tarif_per_jam,
    ]);

    return redirect()->route('admin.tarif.index')->with('succes', 'tarif berhasil di tambahkan');
     
} 
        
 

 
    public function edit(Tarif $tarif) 
    { 
        return view('admin.tarif.edit', compact('tarif')); 
    }
    
     public function update(Request $request, Tarif $tarif) 
    { 
        $request->validate([ 
        'jenis_kendaraan' => 'required|in:motor,mobil,lainnya', 
        'tarif_per_jam' => 'required|numeric|min:0', 
    ]); 


          $data = $request->only('jenis_kendaraan', 'tarif_per_jam'); 
 
        $tarif->update($data); 
 
        return redirect()->route('admin.tarif.index')->with('success', 'Tarif berhasil diperbarui.'); 
    } 
 
    public function destroy($id)
{
    $tarif = \App\Models\Tarif::findOrFail($id);

    // Cek apakah tarif sudah digunakan transaksi
    $cekTransaksi = \App\Models\Transaksi::where(
        'id_tarif',
        $tarif->id_tarif
    )->exists();

    if ($cekTransaksi) {
        return redirect()->route('admin.tarif.index')
            ->with('error', 'Tarif tidak bisa dihapus karena sudah digunakan dalam transaksi!');
    }

    $tarif->delete();

    return redirect()->route('admin.tarif.index')
        ->with('success', 'Tarif berhasil dihapus!');
}
} 