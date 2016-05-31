<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ArticlesTableSeeder::class);
        $this->call(UnigramsTableSeeder::class);
        $this->call(BigramsTableSeeder::class);
        $this->call(TrigramsTableSeeder::class);
    }
}
