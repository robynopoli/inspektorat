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
        Schema::create('findings', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lha')->nullable();
            $table->string('kode_rekomendasi')->nullable();
            $table->string('kode_temuan')->nullable();
            $table->longText('tindak_lanjut')->nullable();
            $table->string('nip')->nullable();
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('status')->nullable();
            $table->longText('keterangan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('findings');
    }
};
