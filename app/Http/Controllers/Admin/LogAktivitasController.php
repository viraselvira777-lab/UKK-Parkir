<?php 
 
namespace App\Http\Controllers\Admin; 
 
use App\Http\Controllers\Controller; 
use App\Models\LogAktivitas; 
 
class LogAktivitasController extends Controller 
{ 
    public function index() 
    { 
        $logs = LogAktivitas::with('user')->orderByDesc('waktu_aktivitas')->paginate(15); 
        return view('admin.log.index', compact('logs')); 
    } 
} 
