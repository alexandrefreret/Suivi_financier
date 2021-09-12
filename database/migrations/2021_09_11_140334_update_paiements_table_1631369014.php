<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaiementsTable1631369014 extends Migration
{
    public function up()
    {
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->unsignedInteger("paiements_user");
        });

        // Adding foreign keys
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->foreign('paiements_user')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            Schema::connection('mysql')->disableForeignKeyConstraints();
            $table->dropForeign(['paiements_user']);
            Schema::connection('mysql')->enableForeignKeyConstraints();
            $table->dropColumn('user');
        });
    }
}
