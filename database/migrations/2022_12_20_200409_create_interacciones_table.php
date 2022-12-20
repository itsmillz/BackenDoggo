<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interacciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("perro_interesado") ->nullable();
            $table-> foreign("perro_interesado")-> references("id") -> on("perros");
            $table-> unsignedBigInteger("perro_candidato") -> nullable();
            $table->foreign("perro_candidato")->references("id") -> on("perros");

            $table->char("preferencia");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interacciones');
    }
};
