<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table="cursos";

    protected $fillable = [
       'nameCurso', 'tipo_curso', 'objetivo', 'fecha_I', 'fecha_F',
       'hora_I', 'hora_F', 'dirigido', 'observaciones', 'duracion',
       'periodo', 'tipo_actividad', 'lugar'
    ];

    public function curso_inscritos(){
        return $this->belongsToMany(Docente::class, 'inscripcion', 'curso_id', 'docente_id');
    }
}
