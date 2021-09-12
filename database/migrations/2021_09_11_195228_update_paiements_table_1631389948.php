<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePaiementsTable1631389948 extends Migration
{
    public function up()
    {
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->unsignedInteger("paiements_clients");
        });

        // Adding foreign keys
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->foreign('paiements_clients')->references('clients_id')->on('clients');
        });
    }

    public function down()
    {
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            Schema::connection('mysql')->disableForeignKeyConstraints();
            $table->dropForeign(['paiements_clients']);
            Schema::connection('mysql')->enableForeignKeyConstraints();
            $table->dropColumn('clients');
        });
    }
}
