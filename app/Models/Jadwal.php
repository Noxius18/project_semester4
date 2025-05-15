<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Absen;
use App\Models\Notifikasi;

class Jadwal extends Model
{
    protected $table = "jadwal";
    protected $primaryKey = "jadwal_id";
    protected $keyType = "string";
    public $timestamps = false;
    protected $fillable = [
        "jadwal_id",
        "tipe_jadwal",
        "hari",
        "lokasi",
        "tanggal",
        "waktu_mulai",
        "waktu_selesai",
        "tim_lawan",
        "status"
    ];

    public function getTipeJadwalLabelAttribute() {
        return match($this->tipe_jadwal) {
            'REG' => 'Latihan Reguler',
            'PNG' => 'Latihan Pengganti',
            'PRT' => 'Pertandingan',
            default => 'NULL'
        };
    }

    public function pelatih() {
        return $this->belongsToMany(User::class,"jadwal_pelatih","jadwal_id","pelatih_id");
    }

    public function absensi() {
        return $this->hasMany(Absen::class, 'absen_id');
    }

    public function notifikasi() {
        return $this->hasMany(Notifikasi::class, "notif_id");
    }
}
