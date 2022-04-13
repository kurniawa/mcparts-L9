<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // public $timestamps = false; tidak perlu false, karena memang terpakai
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'spk_produks');
    }

    public function spk_produks()
    {
        return $this->hasMany(SpkProduk::class);
    }
}
