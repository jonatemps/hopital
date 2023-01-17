<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_agent');
            $table->unsignedBigInteger('id_entreprise')->nullable();
            $table->string('nomComplet');
            $table->string('sexe');
            $table->string('dateNaissance');
            $table->string('adresse');
            $table->string('telephone');
            $table->string('matriculeAgent')->nullable();
            $table->string('groupeSanguin');
            $table->timestamps();

            $table->foreign('id_entreprise')->references('id')->on('entreprises')->onDelete('cascade');
            $table->foreign('id_agent')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
