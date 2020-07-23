<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArbolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pregunta',200)->nullable();
            $table->string('resultado',200)->nullable();
            $table->string('nleft',45)->nullable();
            $table->string('nright',45)->nullable();
            $table->string('tipo',45)->nullable();
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
        Schema::dropIfExists('arbol');
    }
}
