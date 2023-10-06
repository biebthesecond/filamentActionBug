<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'request_documents';

    /**
     * Run the migrations.
     * @table request_documents
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->uuid('request_id');
            $table->string('name');
            $table->text('desc')->nullable();
            $table->foreignId('media_id')->nullable();

            $table->index(["request_id"]);
            $table->timestamps();


            $table->foreign('request_id', 'fk_request_documents_requests1_idx')
                ->references('id')->on('requests')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('media_id', 'fk_request_documents_media1_idx')
                ->references('id')->on('media')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
};
