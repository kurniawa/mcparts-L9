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
        Schema::create('spk_produk_nota_srjalans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('produk_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->foreignId('nota_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('srjalan_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('spk_produk_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->foreignId('spk_produk_nota_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->smallInteger('jumlah');
            $table->string('tipe_packing', 20)->nullable();
            $table->smallInteger('jml_packing')->nullable();
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
        Schema::dropIfExists('spk_produk_nota_srjalans');
    }
};
