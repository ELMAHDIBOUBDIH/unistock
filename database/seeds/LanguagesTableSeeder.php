<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('translator_languages')->insert([
            'locale' => 'fr',
            'name' => 'Français'
        ]);
    }
}
