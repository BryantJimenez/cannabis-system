<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Super',
            'lastname' => 'Admin',
        	'photo' => 'usuario.png',
        	'slug' => 'super-admin',
            'phone' => '12345678',
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('12345678'),
        	'state' => "1"
        ]);

        $user=User::find(1);
        $user->assignRole('Super Admin');
    }
}
