<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsImpotsConfigPaiementsPaiementsMethodeRetrocessionConfig1631368945 extends Migration
{
    public function up()
    {
        Schema::connection('mysql')->create('clients', function (Blueprint $table) {
            $table->increments("clients_id");
            $table->timestamp("clients_inserted")->useCurrent();
            $table->timestamp("clients_updated")->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean("clients_valide")->index(true)->default(true);
            $table->string("clients_nom");
            $table->string("clients_prenom");
        });

        Schema::connection('mysql')->create('impots_config', function (Blueprint $table) {
            $table->increments("impotsconfig_id");
            $table->timestamp("impotsconfig_inserted")->useCurrent();
            $table->timestamp("impotsconfig_updated")->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean("impotsconfig_valide")->index(true)->default(true);
            $table->decimal("impotsconfig_abattement_pourcentage", 8, 2);
            $table->decimal("impotsconfig_acre_pourcentage", 8, 2);
            $table->date("impotsconfig_start");
            $table->date("impotsconfig_end")->nullable(true);
        });

        Schema::connection('mysql')->create('paiements', function (Blueprint $table) {
            $table->increments("paiements_id");
            $table->timestamp("paiements_inserted")->useCurrent();
            $table->timestamp("paiements_updated")->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean("paiements_valide")->index(true)->default(true);
            $table->decimal("paiements_montant", 10, 2);
            $table->date("paiements_date");
            $table->unsignedInteger("paiements_methode");
        });

        Schema::connection('mysql')->create('paiements_methode', function (Blueprint $table) {
            $table->increments("paiementsmethode_id");
            $table->timestamp("paiementsmethode_inserted")->useCurrent();
            $table->timestamp("paiementsmethode_updated")->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean("paiementsmethode_valide")->index(true)->default(true);
            $table->string("paiementsmethode_label");
            $table->string("paiementsmethode_code");
        });

        Schema::connection('mysql')->create('retrocession_config', function (Blueprint $table) {
            $table->increments("retroconfig_id");
            $table->timestamp("retroconfig_inserted")->useCurrent();
            $table->timestamp("retroconfig_updated")->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->boolean("retroconfig_valide")->index(true)->default(true);
            $table->decimal("retroconfig_pourcentage", 8, 2);
        });

        Schema::connection('mysql')->table('users', function (Blueprint $table) {
            $table->unsignedInteger("retroconfig")->nullable(true);
        });

        // Adding foreign keys
        Schema::connection('mysql')->table('paiements', function (Blueprint $table) {
            $table->foreign('paiements_methode')->references('paiementsmethode_id')->on('paiements_methode');
        });
        Schema::connection('mysql')->table('users', function (Blueprint $table) {
            $table->foreign('retroconfig')->references('retrocessionconfig_id')->on('retrocession_config');
        });
    }

    public function down()
    {
        Schema::connection('mysql')->table('users', function (Blueprint $table) {
            Schema::connection('mysql')->disableForeignKeyConstraints();
            $table->dropForeign(['retroconfig']);
            Schema::connection('mysql')->enableForeignKeyConstraints();
            $table->dropColumn('retro_config');
        });

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('clients');
        Schema::connection('mysql')->enableForeignKeyConstraints();

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('impots_config');
        Schema::connection('mysql')->enableForeignKeyConstraints();

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('paiements');
        Schema::connection('mysql')->enableForeignKeyConstraints();

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('paiements_methode');
        Schema::connection('mysql')->enableForeignKeyConstraints();

        Schema::connection('mysql')->disableForeignKeyConstraints();
        Schema::connection('mysql')->drop('retrocession_config');
        Schema::connection('mysql')->enableForeignKeyConstraints();
    }
}
