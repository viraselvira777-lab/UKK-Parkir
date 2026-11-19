<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\AreaParkir; 
use Illuminate\Http\Request; 
 
class AreaParkirController extends Controller 
{ 
    public function index() { 
    $areas = AreaParkir::latest()->paginate(10); 
    return view('admin.area.index', compact('areas')); 
   } 

   public function create()
   {
    return view('admin.area.create');
   }


   public function store(Request $request) { 
    $request->validate([ 
        'nama_area' => 'required|string|max:100', 
        'kapasitas' => 'required|integer|min:1', 
    ]); 
    AreaParkir::create([
       'nama_area'=>$request->nama_area,
        'kapasitas'=>$request->kapasitas,
    ]);
    return redirect()->route('admin.area.index')->with('success', 'Area ditambahkan.'); 
} 
        
 

 
    public function edit(AreaParkir $area) 
    { 
        return view('admin.area.edit', compact('area')); 
    }
     public function update(Request $request, AreaParkir $area) 
    { 
        $request->validate([ 
        'nama_area' => 'required|string|max:100', 
        'kapasitas' => 'required|integer|min:1', 
    ]); 

    $data = $request->only('nama_area', 'kapasitas'); 

        $area->update($data); 
 
        return redirect()->route('admin.area.index')->with('success', 'Area berhasil diperbarui.'); 
    } 
 
  public function destroy($id)
{
    $area = AreaParkir::findOrFail($id);

    $cekTransaksi = \App\Models\Transaksi::where(
        'id_area',
        $area->id_area
    )->exists();

    if ($cekTransaksi) {
        return redirect()->route('admin.area.index')
            ->with('error', 'Area parkir tidak bisa dihapus karena sudah digunakan dalam transaksi!');
    }

    $area->delete();

    return redirect()->route('admin.area.index')
        ->with('success', 'Area parkir berhasil dihapus!');
}
} 