<?php

namespace ConfrariaWeb\User\Databases\Seeds;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateUserTables();
        $this->createUsers();
        //$users = User::factory()->count(10)->create();
    }

    private function createUsers()
    {
        $users = [
            [
                'name' => 'Rafael Zingano',
                'email' => 'confrariaweb@gmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        foreach ($users as $user) {
            if (User::where('email', 'confrariaweb@gmail.com')->doesntExist()) {
                User::create($user);
            }
        }
    }

    private function truncateUserTables()
    {
        User::whereNotNull('id')->delete();
    }
}
