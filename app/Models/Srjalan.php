<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Srjalan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function get_pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
