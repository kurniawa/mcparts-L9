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
        Schema::create('pelanggan_ekspedisis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->foreignId('ekspedisi_id')->nullable()->constrained()->onDelete('NO ACTION');
            $table->string('tipe', 20)->nullable()->default('UTAMA');
            $table->timestamp('used_since')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('last_used')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan_ekspedisis');
    }
};
