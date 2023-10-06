<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'name' => $this->faker->name(),
            'name' => $this->faker->randomElement(['French the Farmer', 'Pieter Levensgenieter', 'Henk Tank', 'Piet Vergiet', 'Janet Kroket', 'Ed Raket', 'Koos Dakloos', 'Chanel Frikandel', 'Chantal Bitterbal', 'Renee Kaassoufle', 'Fred Frituurvet', 'Jan Wokpan', 'Noor Grondboor', 'Ad Raspatat', 'Peter Schoenveter', 'Rachid Suikerbiet', 'Hans Hoogglans', 'Daan Banaan', 'Fleur Autodeur', 'Joop Autosloop', 'Rijk Afsluitdijk', 'Marc Autopark', 'Ramon Waterkanon', 'Jaques Frietzak', 'Bjorn Regenworm', 'Wouter de Grotkabouter', 'Koos Stekkerdoos', 'Aag Boomzaag', 'Joep Maaltijdsoep', 'Jans Regendans', 'Babbet Schuiftrompet', 'Oane Tronbone', 'Bob Autodrop', 'John Waterkanon', 'Frans Timmermans']),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
        ];
    }

    public function withPersonalTeam(): static
    {
        if (! Features::hasTeamFeatures()) {
            return $this->state([]);
        }

        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should be the admin of a team.
     *
     * @return $this
     */
    public function withOwnedTeam(Factory $teamHas = null): static
    {
        return $this->has(
            Team::factory()->state(function (array $attributes, User $user) {
                return ['user_id' => $user->id];
            })->has($teamHas),
            'ownedTeams'
        );
    }
}