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
        collect([
            [
                'email' => 'hi@tpenaranda.com',
                'name' => 'Tate',
                'password' => bcrypt('secret'),
                'phone' => '54-341-5851961',
            ],
        ])->mapInto(User::class)->each->save();
    }
}
