<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->text('key');
            $table->text('value')->nullable();
            $table->json('meta')->nullable();
            $table->bigInteger('model_id');
            $table->string('model_type');
            $table->timestamps();
        });

        /** @var \App\Models\User $user */
        foreach (\App\Models\User::all() as $user) {

            $settings = [
                new Setting([
                    'key' => 'acknowledgment_of_receipt_show_subject',
                    'value' => true,
                ]),
                new Setting([
                    'key' => 'acknowledgment_of_receipt_show_content',
                    'value' => true,
                ]),
            ];

            $user->settingsRelation()->saveMany($settings);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
