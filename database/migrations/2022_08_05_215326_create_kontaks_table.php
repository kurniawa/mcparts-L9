<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable();// pelanggan_id dan ekspedisi_id bisa null, karena memang butuh salah satu nya aja.
            $table->foreignId('ekspedisi_id')->nullable();//
            $table->string('tipe', 20)->nullable(); // kantor, rumah, hp
            $table->string('kodearea', 10)->nullable();
            $table->string('nomor', 20)->nullable();
            $table->enum('is_aktual',['yes','no'])->nullable()->default('no'); // ini untuk tujuan bila nomor terakhir belum tentu itu yang seharusnya otomatis tercantum di nota
            $table->string('lokasi',20)->nullable();// keterangan lokasi apabila di perlukan, terutama apabila nomor ini ber relasi dengan alamat.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontaks');
    }
};
