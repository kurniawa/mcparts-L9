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
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 100);
            $table->string("alias", 100)->nullable();
            $table->string("nama_bisnis", 50)->nullable();
            $table->string("bentuk", 10)->nullable(); // bentuk perusahaan
            $table->string("sapaan", 10)->nullable();
            $table->string("no_kontak", 50)->nullable();
            $table->string("initial", 10)->nullable();
            $table->string("ktrg")->nullable();
            $table->enum("is_reseller", ['yes', 'no'])->default('no');
            $table->foreignId("reseller_id")->nullable()->references('pelanggans');
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};
