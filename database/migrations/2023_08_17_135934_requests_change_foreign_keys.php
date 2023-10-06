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
            $table->dropForeign('fk_request_documents_requests1_idx');
            $table->foreign('request_id')
                ->references('uuid')->on('requests')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_documents', function (Blueprint $table) {
            $table->dropForeign(['request_id']);
            $table->foreign('request_id', 'fk_request_documents_requests1_idx')
                ->references('uuid')->on('requests')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });


    }
};
