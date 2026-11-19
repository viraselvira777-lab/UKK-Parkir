<?php

namespace App\Traits;

use App\Models\LogAktivitas;

trait MencatatAktivitas
{
    public function catatAktivitas($aktivitas)
    {
        LogAktivitas::create([
            'id_user' => auth()->id(),
            'aktivitas' => $aktivitas,
            'waktu_aktivitas' => now(),
        ]);
    }
}
