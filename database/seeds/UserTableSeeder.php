<?php

use Illuminate\Database\Seeder;
use TeachMe\Entities\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $this->createAdmin();
    }

    private function createAdmin()
    {
        User::create([
            'name' => 'Migul Torres ',
            'email' => 'mta1830@gmail.com',
            'password' => bcrypt('admin')
        ]);
    }

}
