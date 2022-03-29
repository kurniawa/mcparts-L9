<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ekspedisis()
    {
        return $this->belongsToMany(Ekspedisi::class, 'pelanggan_ekspedisis');
    }

    public function pelanggan_ekspedisis()
    {
        return $this->hasMany(PelangganEkspedisi::class);
    }
}
