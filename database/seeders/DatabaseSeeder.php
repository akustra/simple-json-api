<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Word;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Word::create([
            'pl' => 'dom',
            'en' => 'home',
            'it' => 'la casa'
        ]);

        Word::create([
            'pl' => 'red',
            'en' => 'red',
            'it' => 'rosa'
        ]);

        Word::create([
            'pl' => 'kot',
            'en' => 'cat',
            'it' => 'il gatto'
        ]);
    }
}
