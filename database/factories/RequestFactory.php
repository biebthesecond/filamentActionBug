<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Request;
use App\Models\RequestDocument;
use App\Models\Team;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = now()->addDay();
        return [
            'contact_id' => Contact::inRandomOrder()->first()->id,
            'sender_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->word(),
            'concept' => $this->faker->randomElement([true, false]),
            'message' => $this->faker->paragraph,
            'frequency' => $this->faker->randomElement([null, 'quarterly', 'semi-annually', 'monthly', 'yearly']),
            'start_date' => $startDate,
            'sent_at' => $startDate,
            'end_date' => $this->faker->randomElement([
                $startDate->copy()->addMonths(2),
                $startDate->copy()->addMonth(),
                now()->addDay(),
                now()->addDays(2),
                now()->addDays(7),
                now()->addDays(14),
                now()->addDays(21),
            ]),
            'password' => $this->faker->password(),
        ];
    }

    /**
     * Indicate that the request is sent.
     *
     * @return $this
     */
    public function isSent()
    {
        return $this->state(function (array $attributes) {
            return [
                'sent_at' => now(),
            ];
        });
    }

    /**
     * Indicate that the request should be repeated.
     *
     * @param string $frequency
     * @return RequestFactory
     */
    public function repeating(string $frequency): RequestFactory
    {
        return $this->state(function () use ($frequency) {
            return [
                'frequency' => $frequency,
            ];
        });
    }

    /**
     * Indicate that the request should not be repeated.
     *
     * @return RequestFactory
     */
    public function oneTime(): RequestFactory
    {
        return $this->state(function () {
            return [
                'frequency' => null,
            ];
        });
    }

    /**
     * Indicate that the request is unlocked.
     *
     * @return $this
     */
    public function isUnlocked()
    {
        return $this->state(function (array $attributes) {
            return [
                'sent_at' => now(),
                'unlocked_at' => now(),
            ];
        });
    }

    /**
     * Indicate that the request should contain documents.
     *
     * @return $this
     */
    public function withDocuments(int $amount = 1): static
    {
        return $this->state(function (array $attributes) use ($amount) {
            $this->has(
                RequestDocument::factory($amount)->create()
            );
        });
    }
}
