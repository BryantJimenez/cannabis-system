<?php

use App\Models\Container;
use Illuminate\Database\Seeder;

class ContainersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Container::class, 20)->create(['state' => '1']);
    }
}
