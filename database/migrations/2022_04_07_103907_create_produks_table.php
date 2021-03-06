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
        /**
         * Sebelumnya saya pakai strategi menggunakan file json dikemas dalam bentuk teks ke dalam database,
         * namun setelah development berjalan, saya merasa tetap lebih simple tanpa harus memikirkan file json.
         *
         * Oleh karena itu saya hapus table properties
         */
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('tipe', 50);
            // $table->string('properties');
            // $table->foreignId('bahan_id')->nullable();
            // $table->foreignId('variasi_id')->nullable();
            // $table->foreignId('ukuran_id')->nullable();
            // $table->foreignId('jahit_id')->nullable();
            // $table->foreignId('kombi_id')->nullable();
            // $table->foreignId('tsixpack_id')->nullable();
            // $table->foreignId('japstyle_id')->nullable();
            // $table->foreignId('motif_id')->nullable();
            // $table->foreignId('standar_id')->nullable();
            // $table->foreignId('tankpad_id')->nullable();
            // $table->char('tipe_bahan', 1)->nullable();
            // $table->foreignId('stiker_id')->nullable();
            // $table->foreignId('busastang_id')->nullable();
            $table->string('nama');
            $table->string('nama_nota');
            $table->string('tipe_packing', 20)->nullable();
            $table->smallInteger('aturan_packing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
