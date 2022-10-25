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
        Schema::create('spk_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spk_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('produk_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->string('keterangan')->nullable();
            $table->smallInteger('jumlah');
            $table->smallInteger('deviasi_jml')->nullable()->default(0);
            $table->smallInteger('jml_t')->nullable()->default(0);
            $table->smallInteger('jml_selesai')->nullable()->default(0);
            $table->smallInteger('jml_blm_sls')->nullable();
            $table->smallInteger('jml_sdh_nota')->nullable()->default(0);
            $table->smallInteger('jumlah_sudah_srjalan')->nullable()->default(0);
            $table->integer('harga');
            $table->integer('koreksi_harga')->nullable();
            $table->string('status', 20)->nullable(); // Status yang berkaitan dengan sudah selesai di produksi atau belum
            $table->string('data_selesai')->nullable();
            $table->string('data_nota')->nullable();
            $table->string('data_srjalan')->nullable();
            $table->string('status_nota')->nullable()->default('BELUM');
            $table->string('status_srjalan')->nullable()->default('BELUM');
            $table->timestamp('finished_at')->nullable();
            $table->timestamps();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spk_produks');
    }
};
