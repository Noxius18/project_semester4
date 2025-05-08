<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;
class Absen extends Model
{
    protected $table = "absen";
    protected $primaryKey = "absen_id";
    protected $keyType = "string";
    public $timestamps = false;
    protected $fillable = [
        "absen_id",
        "status",
        "user_id",
        "jadwal_id"
    ];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
    
    public function jadwal() {
        return $this->belongsTo(Jadwal::class, "jadwal_id");
    }
}
