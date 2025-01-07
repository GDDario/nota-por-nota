<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name'  => 'Jhon Doe',
            'email' => 'jhon@doe.com',
        ]);

        User::factory(9)->create();
    }
}
