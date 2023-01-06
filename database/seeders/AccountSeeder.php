<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Andry',
                'email' => 'ajm.bjm2016@gmail.com',
                'password' => bcrypt('admin123'),
                'level' => 'koordinator',
                'status' => 1
            ],
            [
                'name' => 'Rahmat Maulana',
                'email' => 'lana1512@gmail.com',
                'password' => bcrypt('staff123'),
                'level' => 'staff',
                'status' => 1
            ],
            [
                'name' => 'Masliani',
                'email' => 'masliani72@gmail.com',
                'password' => bcrypt('owner123'),
                'level' => 'owner',
                'status' => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
