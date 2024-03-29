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
        Schema::create('academicos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->BigIncrements('id');
            $table->unsignedBigInteger('egresado_id');
            $table->unsignedBigInteger('modalidad_id');
            $table->string('matricula', 10);
            $table->string('licenciatura', 10);
            $table->float('promedio', 2, 2);

            $table->timestamps();

            $table->foreign('egresado_id')->references('id')->on('egresados')->OnDelete('cascade');
            $table->foreign('modalidad_id')->references('id')->on('modalidades')->OnDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academicos');
    }
};
