<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('language')->delete();
        DB::collection('language')->insert(['id' => 'en','name' => 'English', 'seed' => true]);
        DB::collection('language')->insert(['id' => 'fr','name' => 'Français', 'seed' => true]);
    }
}
