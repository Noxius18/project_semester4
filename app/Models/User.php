<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Roles;
use App\Models\Jadwal;
use App\Models\Absen;
class User extends Model
{
    protected $table = "user";
    protected $primaryKey = "user_id";
    protected $keyType = "string";
    public $timestamp = false;

    protected $fillable = [
        "user_id",
        "nama",
        "username",
        "password",
        "jenis_kelamin",
        "role_id"
    ];

    protected $hidden = [
        "password",
        "remember_token"
    ];

    protected $casts = [
        'password' => 'hashed'
    ];

    public function role() {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function jadwal() {
        return $this->belongsToMany(Jadwal::class,'jadwal_pelatih','pelatih_id','jadwal_id');
    }

    public function absensi() {
        return $this->hasMany(Absen::class, 'absen_id');
    }
}
