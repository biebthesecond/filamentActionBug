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
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->uuid('uuid')->after('id');
            $table->unsignedBigInteger('invited_user_id')->after('uuid');
            $table->date('expiration_date')->after('role');
            $table->dropColumn('role');

            $table->foreign('invited_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->dropForeign(['invited_user_id']);
            $table->dropColumn('uuid');
            $table->dropColumn('invited_user_id');
            $table->dropColumn('expiration_date');
            $table->string('role')->nullable()->after('email');
        });
    }
};
