<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'language' => 'English',
                'code' => 'en'
            ],
            [
                'language' => 'French',
                'code' => 'fr'
            ],
            [
                'language' => 'German',
                'code' => 'de'
            ],
            [
                'language' => 'Belgium',
                'code' => 'be'
            ],
            [
                'language' => 'Dutch',
                'code' => 'nl'
            ]

        ]);
    }
}
