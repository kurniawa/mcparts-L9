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
        Schema::create('attsjvariasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id');
            $table->foreignId('variasi_id');
            $table->foreignId('varian_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attsjvariasis');
    }
};
