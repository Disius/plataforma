<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Docente extends Model
{
    use HasFactory;
    protected $table = 'docente';

    protected $fillable = [ 'rfc', 'curp', 'nombre', 'apellidoPat', 'apellidoMat',
        'sexo', 'email', 'departamento_id', 'telefono', 'interno', 'carrera_id', 'user_id', 'id_puesto', 'tipo_plaza'
    ];

    public function facilitador_has_deteccion(){
        return $this->belongsToMany(DeteccionNecesidades::class, 'deteccion_has_facilitadores', 'docente_id', 'deteccion_id');
    }

    public function docente_inscrito(){
        return $this->belongsToMany(Curso::class, 'inscripcion', 'docente_id', 'curso_id');
    }

    public function Users(){
        return $this->belongsTo(User::class, 'docente_id');
    }
    
    public function detecciones(): HasMany
    {
        return $this->hasMany(DeteccionNecesidades::class, 'id_jefe');
    }
}
