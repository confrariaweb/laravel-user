<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{

    public function up()
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {

                $table->unsignedBigInteger('status')
                    ->after('id')
                    ->default(1);

                $table->text('settings')
                    ->nullable()
                    ->default(null)
                    ->after('email');

                $table->text('options')
                    ->nullable()
                    ->default(null)
                    ->after('settings');

                $table->string('api_token', 80)
                    ->after('password')
                    ->unique()
                    ->nullable()
                    ->default(null);

                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        //
    }
}
