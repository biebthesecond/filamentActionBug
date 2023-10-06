<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => User::factory(),
            'receiver_id' => Contact::factory(),
            'email_receiver' => $this->faker->email,
            'name' => $this->faker->sentence(6, true),
            'content' => $this->faker->sentences(3, true),
            'sent_type' => $this->faker->randomElement([
                'password'
            ]),
            'phone_number' => null,
            'password' => bcrypt('secret'),
            'downloadable' => true,
            'expires_at' => now()->addWeeks(2),
            'scheduled_at' => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Message $message) {

            $max = rand(2, 5);

            for ($i = 0; $i < $max; $i++) {
                $faker = \Faker\Factory::create();
                $imageUrl = $faker->imageUrl(640, 480, null, false);

                $message->addMediaFromUrl($imageUrl)->toMediaCollection('files');
            }
        });
    }
}
