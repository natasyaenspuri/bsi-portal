<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke User (Marketing) dihapus karena Rekening milik Nasabah offline
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
