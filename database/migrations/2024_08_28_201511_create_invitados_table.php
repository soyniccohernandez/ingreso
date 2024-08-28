<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invitados', function (Blueprint $table) {
            $table->id(); // Genera un campo id auto-incremental
            $table->string('identificacion')->unique(); // Campo de identificación
            $table->string('nombre'); // Campo de nombre
            $table->string('email');// Campo de email
            $table->string('tipo'); // Campo para tipo de invitación
            $table->boolean('ingreso')->default(0); // Campo para estado de invitación (booleano, por defecto es 0)
            $table->foreignId('id_evento')->constrained('eventos')->onDelete('cascade'); // Campo foráneo id_evento referenciando a eventos
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('invitados', function (Blueprint $table) {
            $table->dropForeign(['id_evento']); // Elimina la restricción de clave foránea
        });
        Schema::dropIfExists('invitados'); // Elimina la tabla
    }
};
