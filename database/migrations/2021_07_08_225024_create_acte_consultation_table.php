<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActeConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acte_consultation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_acte');
            $table->unsignedBigInteger('id_consultation');
            $table->timestamps();

            $table->foreign('id_acte')->references('id')->on('actes')->onDelete('cascade');
            $table->foreign('id_consultation')->references('id')->on('consultations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acte_consultation');
    }
}
