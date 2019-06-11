<?php

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
        $this->call(LevelsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CategoriesDescriptionTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(LevelsDescriptionTableSeeder::class);
        $this->call(PriceTableSeeder::class);
    }
}
