<?php
namespace ConfrariaWeb\User\Databases\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

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
                'password' => 'secret',
            ]
        ];
        foreach ($users as $user) {
            if (DB::table('users')->where('email', $user['email'])->doesntExist()) {
                DB::table('users')->insert([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                ]);
            }
        }
    }

    private function truncateUserTables()
    {
        Schema::disableForeignKeyConstraints();
        $this->command->info('Fazendo um truncate nas tabelas de usuarios, sai da frente... ;/');
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        $this->command->info('Pronto, truncates de usuarios feitos, acho que com sucesso :D');
    }
}
