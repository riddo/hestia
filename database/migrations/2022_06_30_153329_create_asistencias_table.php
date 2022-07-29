<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->text('registro_tipo')->nullable();
            $table->timestamp('registro_fecha')->useCurrent();
            // $table->date('fecha_salida')->nullable();
            // $table->time('hora_salida')->nullable();
            // $table->integer('marcaciones')->nullable();
            $table->foreignId('asistencia_idEmpleado')
            ->nullable()
            ->constrained('empleados')
            ->cascadeOnUpdate()
            ->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencias');
    }
}
