<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $table='tb_user';
    protected $primaryKey='id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_lengkap','username','password','role','status_aktif',];

    protected $hidden=['password','remember_token'];
    
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class,'id_user','id_user');
    }

    public function transaksi()
    {
        return $this-hasMany(Transaksi::class,'id_user','id_user');
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class,'id_user','id_user');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

}
