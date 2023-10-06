<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Message;
use App\Models\Request;
use App\Models\RequestDocument;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(3)
            ->withOwnedTeam(
                User::factory(6)
                    ->has(
                        Contact::factory(4)
                            ->has(
                                Request::factory(4)
                                    ->has(
                                        RequestDocument::factory(3),
                                        'documents'
                                    )
                            )
                    )
            )
            ->create();


//         \App\Models\User::factory(6)->create();
        \App\Models\Message::factory(10)->create();

        $this->call(ActivityLogSeeder::class);
    }
}
