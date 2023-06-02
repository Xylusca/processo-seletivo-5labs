<?php

use Illuminate\Database\Seeder;
use Database\Seeders\NiveisSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NiveisSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
