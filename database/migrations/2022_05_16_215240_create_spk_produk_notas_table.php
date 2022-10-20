<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('spk_produk_notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('produk_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->foreignId('spk_produk_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->foreignId('nota_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->smallInteger('jumlah');
            $table->foreignId('produk_harga_id')->nullable()->constrained()->onDelete('NO ACTION'); // Ini perlu untuk acuan dalam pengeditan harga nantinya
            $table->foreignId('pelanggan_produk_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->foreignId('namaproduk_id')->nullable()->constrained('pelanggan_namaproduks','id')->onDelete('NO ACTION');
            $table->enum('is_price_updated',['yes','no'])->nullable()->default('no');
            // Nota Selesai: Acuan nya ternyata sudah harga dan harga_t dibawah ini:
            $table->string('nama_nota')->nullable();
            $table->integer('harga');
            $table->integer('harga_t');
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
        Schema::dropIfExists('spk_produk_notas');
    }
};
