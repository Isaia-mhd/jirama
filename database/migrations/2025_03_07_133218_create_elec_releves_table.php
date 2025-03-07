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
        Schema::create('elec_releves', function (Blueprint $table) {
            $table->id();
            $table->string("code_elec");
            $table->foreignId("compteur_id");
            $table->integer("valeur")->default(1);
            $table->date("date_releve");
            $table->date("date_presentation");
            $table->date("date_limite");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elec_releves');
    }
};
