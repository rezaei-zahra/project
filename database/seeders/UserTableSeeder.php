<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        if (!User::count()) {
            $this->registerData();
        }
    }

    private function registerData()
    {
        User::create([
            'firstName' => 'user1',
            'lastName' => 'user1',
            'phoneNumber' => '09999999999',
            'email' => 'user1@test.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
        ]);

        User::create([
            'firstName' => 'user2',
            'lastName' => 'user2',
            'phoneNumber' => '0888888888',
            'email' => 'user2@test.com',
            'password' => bcrypt('123456'),
            'role' => 'user',

        ]);

        User::create([
            'firstName' => 'user3',
            'lastName' => 'user3',
            'email' => 'user3@test.com',
            'phoneNumber' => '07777777777',
            'password' => bcrypt('123456'),
            'role' => 'doctor',
            'specialty' => 'دندانپزشک',
            'systemNumber' => '123',
            'address' => 'میدان امامت',
            'degree' => 'فوق دکتری',
            'city' => 'مشهد',
        ]);
        User::create([
            'firstName' => 'user4',
            'lastName' => 'user4',
            'email' => 'user4@test.com',
            'phoneNumber' => '06666666666',
            'password' => bcrypt('123456'),
            'role' => 'doctor',
            'specialty' => 'دندانپزشک',
            'systemNumber' => '345',
            'address' => 'میدان امامت',
            'degree' => 'فوق دکتری',
            'city' => 'تهران',
        ]);
    }
}
