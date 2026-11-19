<?php 
namespace Database\Seeders; 
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\Hash; 
use App\Models\User; 
class UserSeeder extends Seeder 
{ 


  public function run(): void 
 { 

  User::create([ 
   'nama_lengkap' => 'Administrator', 
   'username' => 'admin', 
   'password' => Hash::make('admin123'), 
   'role' => 'admin', 
   'status_aktif' => 1, 
   ]); 
  User::create([ 
   'nama_lengkap' => 'Petugas Parkir', 
   'username' => 'petugas', 
   'password' => Hash::make('petugas123'), 
   'role' => 'petugas', 
   'status_aktif' => 1, 
   ]); 
  User::create([ 
   'nama_lengkap' => 'Pemilik Usaha', 
   'username' => 'owner', 
   'password' => Hash::make('owner123'), 
   'role' => 'owner', 
   'status_aktif' => 1, 
   ]); 
} 
} 