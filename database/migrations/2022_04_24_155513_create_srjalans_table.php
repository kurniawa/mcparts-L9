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
        Schema::create('srjalans', function (Blueprint $table) {
            $table->id();
            $table->string('no_srjalan', 20)->nullable();
            $table->foreignId('pelanggan_id')->nullable();
            $table->foreignId('ekspedisi_id')->nullable();
            $table->foreignId('ekspedisi_transit_id')->nullable();
            $table->bigInteger('reseller_id')->nullable();
            $table->string('status', 50)->default('PROSES KIRIM');
            // $table->smallInteger('jumlah')->nullable(); tidak perlu ada detail jumlah disini, karena sudah ada di spk_produk_nota_srjalan
            $table->smallInteger('jml_colly')->nullable();
            $table->smallInteger('jml_dus')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('srjalans');
    }
};
