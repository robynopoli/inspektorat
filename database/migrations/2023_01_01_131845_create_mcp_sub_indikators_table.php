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
        Schema::create('mcp_sub_indikators', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan')->nullable();
            $table->foreignId('mcp_indikator_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('obrik_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('mcp_sub_indikators');
    }
};
