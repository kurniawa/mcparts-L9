<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function Harga()
    {
        return $this->hasMany(ProdukHarga::class);
    }

    public function spk()
    {
        return $this->belongsToMany(Spk::class);
    }
}
