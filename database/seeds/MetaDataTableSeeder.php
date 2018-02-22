<?php

use Illuminate\Database\Seeder;

class MetaDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\MetaData')->create();
    }
}
