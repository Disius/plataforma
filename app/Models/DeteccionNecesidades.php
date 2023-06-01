<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeteccionNecesidades extends Model
{
    use HasFactory;
    protected $table = 'deteccion_necesidades';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asignaturaFA', 'contenidosTM', 'numeroProfesores', 'periodo',
        'nombreCurso', 'fecha_I', 'fecha_F', 'hora_I', 'hora_F', 'objetivoEvento', 'tipo_FDoAP', 'tipo_actividad',
        'carrera_dirigido', 'observaciones', 'id_jefe', 'obs', 'aceptado', 'modalidad'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    public function deteccion_facilitador(){
        return $this->belongsToMany(Docente::class, 'deteccion_has_facilitadores', 'deteccion_id', 'docente_id');
    }
}
