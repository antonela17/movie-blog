<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = new User();
        $user1->name = 'admin';
        $user1->username = 'admin';
        $user1->email = 'admin@movie.com';
        $user1->password = Hash::make('12345678');
        $user1->roleId = 1;
        $user1->save();

        $user2 = new User();
        $user2->name = 'Antonela';
        $user2->surname = 'Kolaj';
        $user2->username = 'antonela';
        $user2->email = 'antonela@movie.com';
        $user2->password = Hash::make('12345678');
        $user2->roleId = 1;
        $user2->save();
    }
}
