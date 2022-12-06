<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
         \App\Models\Todo::factory(5)->create();

        \App\Models\Todo::factory()->create([
            'name' => 'Test',
            'mobile' => '9259176042',
        ]);
    }
}
