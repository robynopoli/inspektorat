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
        Schema::create('mcp_tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->text('link_tindak_lanjut')->nullable();
            $table->boolean('is_approve')->default(false);
            $table->foreignId('mcp_document_id')->nullable()->constrained()->onDelete('set null');
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
        Schema::dropIfExists('mcp_tindak_lanjuts');
    }
};
