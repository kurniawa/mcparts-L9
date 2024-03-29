<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkProduk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    //

    public function produks()
    {
        return $this->belongsTo(Produk::class);
    }
}
