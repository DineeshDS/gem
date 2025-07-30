<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@gemgem.com'
            ], [
                'name' => 'Admin',
                'password' => bcrypt('1@Gemgem'),
                'email_verified_at' => now()
        ]);
    }
}
