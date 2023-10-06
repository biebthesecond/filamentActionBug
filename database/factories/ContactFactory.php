<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => $this->faker->uuid(),
            'name' => $this->faker->unique()->name(),
            'owner_id' => User::factory(),
            'owner_type' => User::class,
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }

    /**
     * Indicate that the owner is the team.
     *
     * @return $this
     */
    public function belongsToTeam(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'owner_id' => Team::factory(),
                'owner_type' => Team::class,
            ];
        });
    }
}
