<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bon');
            $table->unsignedBigInteger('id_examen');
            $table->unsignedBigInteger('laboratin_id')->nullable();
            $table->string('decision')->nullable();
            $table->boolean('aquite')->nullable();
            $table->timestamps();

            $table->foreign('id_bon')->references('id')->on('bons')->onDelete('cascade');
            $table->foreign('laboratin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_examen')->references('id')->on('examens')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resultats');
    }
}
