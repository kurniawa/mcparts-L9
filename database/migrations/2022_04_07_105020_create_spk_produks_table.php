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
            $table->foreignId('produk_id');
            $table->string('ktrg')->nullable();
            $table->mediumInteger('jumlah');
            $table->mediumInteger('deviasi_jml')->nullable()->default(0);
            $table->mediumInteger('jml_t')->nullable()->default(0);
            $table->mediumInteger('jml_selesai')->nullable()->default(0);
            $table->mediumInteger('jml_blm_sls')->nullable()->default(0);
            $table->mediumInteger('jml_sdh_nota')->nullable()->default(0);
            $table->integer('harga');
            $table->integer('koreksi_harga')->nullable();
            $table->string('status', 20)->nullable(); // Status yang berkaitan dengan sudah selesai di produksi atau belum
            $table->string('jmlSelesai_kapan')->nullable();
            $table->string('nota_jml_kapan')->nullable();
            $table->string('status_nota')->nullable()->default('BELUM');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            // $table->timestamp('finished_at')->nullable();
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
