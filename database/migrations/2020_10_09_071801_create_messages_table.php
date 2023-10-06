<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('sender_id');
            $table->string('receiver_id')->nullable();
            $table->string('email_receiver')->nullable();
            $table->string('subject');
            $table->text('content');
            $table->string('sent_type');
            $table->string('phone_number')->nullable();
            $table->string('password')->nullable();
            $table->boolean('downloadable')->nullable()->default(true);
            $table->dateTime('expires_at');
            $table->dateTime('scheduled_at')->nullable();
            $table->dateTime('unlocked_at')->nullable();
            $table->dateTime('downloaded_at')->nullable();
            $table->timestamps();

            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
