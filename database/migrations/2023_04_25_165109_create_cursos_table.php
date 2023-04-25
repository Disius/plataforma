<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nameCurso', 60);
            $table->integer('tipo_curso');
            $table->integer('objetivo', 60);
            $table->date('fecha_I');
            $table->date('fecha_F');
            $table->integer('lugar');
            $table->time('hora_I');
            $table->time('hora_F');
            $table->integer('dirigido');
            $table->integer('duracion');
            $table->integer('periodo');
            $table->string('observaciones');
            $table->integer('tipo_actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
