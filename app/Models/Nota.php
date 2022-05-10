<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function nota_item()
    {
        return $this->hasMany(SpkProduk::class);
    }

    public function spk_produk_notas()
    {
        return $this->hasMany(SpkProdukNota::class);
    }
    public function spk_produks()
    {
        return $this->belongsToMany(SpkProduk::class, 'spk_produk_notas');
    }

}
