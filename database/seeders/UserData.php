<?php

namespace Database\Seeders;

use App\Helpers\Helper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $username = Helper::UserNameGenerator(new User, 'username', 5, 'SPA');

        $user = [
            [
                'username' => 'SPA-00000',
                'nama' => 'Tes',
                'password' => bcrypt('123456'),
                'level' => 1,
            ],
            [
                'username' => 'SPA-00001',
                'nama' => 'Tes 2',
                'password' => bcrypt('123456'),
                'level' => 2,
            ],

        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
