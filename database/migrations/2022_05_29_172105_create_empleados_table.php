<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('empleado_nombre', 70);
            $table->string('empleado_apellido', 70);
            $table->string('empleado_rut', 12);
            $table->string('empleado_fono', 50)->nullable();
            $table->text('empleado_direccion')->nullable();
            $table->string('empleado_correo', 70)->nullable();
            $table->string('empleado_genero', 30);
            $table->string('codigo', 50);
            $table->integer('estado_turno')->nullable();
            $table->foreignId('empleado_idCargo')
                ->nullable()
                ->constrained('cargos')
                ->cascadeOnUpdate()
                ->nullOnDelete();
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
        Schema::dropIfExists('empleados');
    }
}
