<?php

use Illuminate\Database\Seeder;

class StrainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strains = [
        	['id' => 1, 'name' => 'Orange Truffle', 'slug' => 'orange-truffle', 'state' => '1'],
        	['id' => 2, 'name' => 'Cool Gelatto #56', 'slug' => 'cool-gelatto-56', 'state' => '1'],
        	['id' => 3, 'name' => 'Mac Punch', 'slug' => 'mac-punch', 'state' => '1'],
        	['id' => 4, 'name' => 'French Macaroon', 'slug' => 'french-macaroon', 'state' => '1'],
        	['id' => 5, 'name' => 'Sun Good', 'slug' => 'sun-good', 'state' => '1'],
            ['id' => 6, 'name' => 'Roadkill Skunk', 'slug' => 'roadkill-skunk', 'state' => '1'],
            ['id' => 7, 'name' => 'Girls Scout Skunk', 'slug' => 'girls-scout-skunk', 'state' => '1'],
            ['id' => 8, 'name' => 'Pure Kush', 'slug' => 'pure-kush', 'state' => '1'],
            ['id' => 9, 'name' => 'Sour Trop', 'slug' => 'sour-trop', 'state' => '1'],
            ['id' => 10, 'name' => 'Terpstastic', 'slug' => 'terpstastic', 'state' => '1']
    	];
    	DB::table('strains')->insert($strains);
    }
}
