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
        Schema::create('pelanggan_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable()->onDelete('NO ACTION');
            $table->foreignId('produk_id')->nullable()->onDelete('NO ACTION');
            $table->foreignId('nota_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->integer('harga_khusus')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan_produks');
    }
};
