<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
        	['id' => 1, 'qty_plants' => 5]
    	];
    	DB::table('settings')->insert($settings);
    }
}
