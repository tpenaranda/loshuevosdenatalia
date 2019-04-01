<?php

use App\User;
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
        $users = [
            [
                'email' => 'admin@loshuevosdenati.com',
                'name' => 'Admin',
                'password' => bcrypt('bebita'),
                'phone' => '54-341-0000000',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['email' => $user['email']], [
                'name' => $user['name'],
                'password' => $user['password'],
                'phone' => $user['phone'],
            ]);
        }
    }
}
