<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemiseChequesPaiementsTables1631430862 extends Migration
{
    public function up()
    {
        Schema::connection('mysql')->create('remise_cheques', function (Blueprint $table) {
            $table->increments("remisecheques_id");
            $table->timestamp("remisecheques_inserted")->useCurrent();
            $table->timestamp("remisecheques_updated")->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean("remisecheques_valide")->index(true)->default(true);
            $table->string("remisecheques_numero");
            $table->date("remisecheques_date");
        });

        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->unsignedInteger("paiements_remisecheques")->nullable(true);
        });

        // Adding foreign keys
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->foreign('paiements_remisecheques')->references('remisecheques_id')->on('remise_cheques');
        });
    }

    public function down()
    {
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            Schema::connection('mysql')->disableForeignKeyConstraints();
            $table->dropForeign(['paiements_remisecheques']);
            Schema::connection('mysql')->enableForeignKeyConstraints();
            $table->dropColumn('remise_cheques');
        });

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('remise_cheques');
        Schema::connection('mysql')->enableForeignKeyConstraints();
    }
}
