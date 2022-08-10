<?php

use Illuminate\Database\Seeder;

class HarvestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $harvests = [
        	['id' => 1, 'name' => 'H6.1', 'slug' => 'h61', 'state' => '1'],
        	['id' => 2, 'name' => 'H6.2', 'slug' => 'h62', 'state' => '1']
    	];
    	DB::table('harvests')->insert($harvests);
    }
}
