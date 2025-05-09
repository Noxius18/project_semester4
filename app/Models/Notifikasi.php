<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

class Notifikasi extends Model
{
    protected $table = "notifikasi";
    protected $primaryKey = "notif_id";
    protected $keyType = "string";
    public $timestamps = false;
    protected $fillable = [
        "notif_id",
        "pesan",
        "status_notif",
        "jadwal_id"
    ];

    public function jadwal() {
        return $this->belongTo(Jadwal::class, "jadwal_id");
    }
}
