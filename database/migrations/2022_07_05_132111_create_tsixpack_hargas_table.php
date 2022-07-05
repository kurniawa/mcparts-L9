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
        Schema::create('tsixpack_hargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tsixpack_id');
            // $table->char('tipe_bahan', 1);
            $table->enum("tipe_bahan", ['A', 'B'])->nullable();
            $table->integer("harga");
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
        Schema::dropIfExists('tsixpack_hargas');
    }
};
