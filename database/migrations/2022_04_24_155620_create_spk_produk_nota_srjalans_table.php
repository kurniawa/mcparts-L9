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
            $table->foreignId('srjalan_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('spk_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('spk_produk_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('produk_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('spk_produk_nota_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignId('nota_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->smallInteger('jumlah');
            $table->smallInteger('colly')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('spk_produk_nota_srjalans');
    }
};
