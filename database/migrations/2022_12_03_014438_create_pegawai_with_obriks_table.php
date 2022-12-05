<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('pegawai_with_obriks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id')->nullable();
            $table->foreignId('obrik_id')->nullable();
//            $table->string('nip', 50)->nullable();
//            $table->string('kode_bidang_obrik')->nullable();
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
        Schema::dropIfExists('pegawai_with_obriks');
    }
};
