<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Roles extends Model
{
    protected $table = "roles";
    protected $primaryKey = "role_id";
    protected $keyType = "char";
    public $timestamp = false;
    protected $fillable = [ "role" ];

    public function users() {
        return $this->hasMany(User::class, 'role_id');
    }
}
