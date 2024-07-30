<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qrcode extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function r_author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
