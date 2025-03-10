<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('releves', function (Blueprint $table) {
            $table->id();
            $table->date("date_releve")->nullable();
            $table->date("date_presentation")->nullable();
            $table->date("date_limite")->nullable();
            $table->string("titulaire");
            $table->string("ref_client");
            $table->string("adresse");
            $table->string("compteur_eau");
            $table->integer("pu_compteur_eau");
            $table->integer("valeur_releve_eau");
            $table->integer("total_eau");
            $table->string("compteur_elec");
            $table->integer("pu_compteur_elec");
            $table->integer("valeur_releve_elec");
            $table->integer("total_elec");
            $table->integer("net_payer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('releves');
    }
};
