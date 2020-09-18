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
                    ->after('remember_token');

                $table->text('options')
                    ->nullable()
                    ->after('settings');

                /*$table->string('api_token', 80)
                    ->unique()
                    ->nullable()
                    ->after('options');*/

                $table->softDeletes();
            });
        }
    }

    public function down()
    {
        //
    }
}
