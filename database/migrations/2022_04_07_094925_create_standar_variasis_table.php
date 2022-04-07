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
        Schema::create('standar_variasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('standar_id');
            $table->enum('jahit_kepala', ['yes', 'no'])->default('yes');
            $table->enum('jahit_samping', ['yes', 'no'])->nullable();
            $table->enum('press', ['yes', 'no'])->nullable();
            $table->enum('alas', ['yes', 'no'])->nullable();
            $table->integer('harga');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('standar_variasi_hargas');
    }
};
