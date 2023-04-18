<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docente';

    protected $fillable = [ 'rfc', 'curp', 'nombre', 'apellidoPat', 'apellidoMat',
        'sexo', 'email', 'clave_departamento', 'telefono', 'interno', 'carrera_id'
    ];

    public function facilitador_has_deteccion(){
        return $this->belongsToMany(DeteccionNecesidades::class, 'deteccion_has_facilitadores', 'docente_id', 'deteccion_id');
    }
}
