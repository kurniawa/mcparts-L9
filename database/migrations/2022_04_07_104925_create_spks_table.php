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
        Schema::create('spks', function (Blueprint $table) {
            $table->id();
            $table->string('no_spk', 20)->nullable();
            $table->foreignId('pelanggan_id')->nullable()->constrained('pelanggans')->onDelete('NO ACTION');
            $table->foreignId('reseller_id')->nullable()->constrained('pelanggans')->onDelete('NO ACTION');
            $table->string('status', 50);
            $table->string('judul')->nullable();
            // $table->text('data_spk_item');
            $table->integer('jumlah_total');
            $table->integer('harga_total');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('NO ACTION');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('NO ACTION');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('spks');
    }
};
