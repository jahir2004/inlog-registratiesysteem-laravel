<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users with different roles
        User::updateOrCreate(
            ['email' => 'praktijk@smilepro.nl'],
            [
                'name' => 'Praktijkmanager',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'rolename' => 'praktijkmanagement',
            ]
        );

        User::updateOrCreate(
            ['email' => 'tandarts@smilepro.nl'],
            [
                'name' => 'Tandarts',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'rolename' => 'tandarts',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@smilepro.nl'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'rolename' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Tester',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'rolename' => 'tester',
            ]
        );

        User::updateOrCreate(
            ['email' => 'tandarts@smilepro.com'],
            [
                'name' => 'Tandarts 2',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'rolename' => 'tandarts2',
            ]
        );

        User::updateOrCreate(
            ['email' => 'voorbeeld@example.com'],
            [
                'name' => 'Voorbeeld',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'rolename' => 'voorbeeld',
            ]
        );
    }
}
