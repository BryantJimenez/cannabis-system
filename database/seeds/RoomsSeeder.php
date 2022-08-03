<?php

use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [
        	['id' => 1, 'name' => 'Dry room #1', 'slug' => 'dry-room-1', 'state' => '1'],
        	['id' => 2, 'name' => 'Dry Room #2', 'slug' => 'dry-room-2', 'state' => '1']
    	];
    	DB::table('rooms')->insert($rooms);
    }
}
