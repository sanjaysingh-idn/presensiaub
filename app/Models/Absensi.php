<?php

namespace App\Models;

use App\Models\User;
use App\Models\Qrcode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Define the relationship with the User model (only mahasiswa)
    public function r_mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }

    // Define the relationship with the Qrcode model
    public function r_qrcode()
    {
        return $this->belongsTo(Qrcode::class, 'id_qrcode', 'id');
    }
}
