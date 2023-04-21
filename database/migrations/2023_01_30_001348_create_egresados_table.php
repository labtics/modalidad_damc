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
        Schema::create('egresados', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->Bigincrements('id');
            $table->string('nombre', 100);
            $table->string('apellidos',100);
            $table->string('sexo',10);
            $table->string('estado_civil',12);
            $table->integer('edad');
            $table->string('email');
            $table->string('telefono',10);
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
        Schema::dropIfExists('egresados');
    }
};
