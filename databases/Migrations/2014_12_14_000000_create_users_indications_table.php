<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersIndicationsTable extends Migration
{

    //indicator
    //indicated
    public function up()
    {
        if (!Schema::hasTable('user_indications') && Schema::hasTable('users')) {

            Schema::create('user_indications', function (Blueprint $table) {
                $table->unsignedBigInteger('indicated_id');
                $table->unsignedBigInteger('indicator_id');

                $table->foreign('indicated_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');

                $table->foreign('indicator_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            });

        }
    }

    public function down()
    {
        Schema::dropIfExists('user_indications');
    }
}
