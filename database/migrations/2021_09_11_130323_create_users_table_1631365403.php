<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable1631365403 extends Migration
{
    public function up()
    {
        Schema::connection('mysql')->table('users', function (Blueprint $table) {
            $table->string("firstname");
        });
    }

    public function down()
    {
        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('users');
        Schema::connection('mysql')->enableForeignKeyConstraints();
    }
}
