<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleReparacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_reparacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_reparacion')->nullable();
            $table->string('repuesto')->nullable();
            $table->string('mantencion')->nullable();
            $table->string('costo')->nullable();
            $table->string('observacion')->nullable();
            $table->enum('estado', ['Reposo', 'Mantenimiento', 'Finalizado'])->nullable();
            
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
        Schema::dropIfExists('detalle_reparacion');
    }
}
