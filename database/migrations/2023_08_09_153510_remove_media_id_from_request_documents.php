<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('request_documents', function (Blueprint $table) {
            $table->dropForeign('fk_request_documents_media1_idx');
            $table->dropColumn('media_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_documents', function (Blueprint $table) {
            $table->foreignId('media_id')->nullable();
            $table->foreign('media_id', 'fk_request_documents_media1_idx')
                ->references('id')->on('media')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
};
