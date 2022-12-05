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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 50)->nullable();
            $table->string('nama', 255);
            $table->string('pangkat', 255)->nullable();
            $table->string('golongan', 50)->nullable();
            $table->string('eselon', 50)->nullable();
            $table->string('jabatan', 255)->nullable();
            $table->string('ket_jabatan', 255)->nullable();
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
        Schema::dropIfExists('pegawais');
    }
};
