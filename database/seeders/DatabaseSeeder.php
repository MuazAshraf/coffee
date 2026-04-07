<?php

namespace Database\Seeders;

use App\Models\Bean;
use App\Models\Brew;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Bean::factory()
            ->count(5)
            ->for($user)
            ->create()
            ->each(function (Bean $bean) use ($user) {
                Brew::factory()
                    ->count(4)
                    ->for($user)
                    ->for($bean)
                    ->create();
            });
    }
}
