<?php

namespace ConfrariaWeb\User\Databases\Seeds;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
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
    }

    private function createUsers()
    {
        $users = [
            [
                'name' => 'Rafael Zingano',
                'email' => 'rafazingano@gmail.com',
                'password' => Hash::make('secret'),
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        if(existsAccount()) {
            $users[0]['account_id'] = 1;
        }
        foreach ($users as $user) {
            if(User::where('id', 1)->doesntExist()){
                User::create($user);
            }
        }
    }

    private function truncateUserTables()
    {
        $this->command->info('Fazendo um truncate nas tabelas de usuarios, sai da frente... ;/');
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $this->command->info('Pronto, truncates de usuarios feitos, acho que com sucesso :D');
    }
}
