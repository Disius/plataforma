<?php

namespace App\Models;

use GrahamCampbell\ResultType\Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeteccionNecesidades extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'deteccion_necesidades';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asignaturaFA', 'contenidosTM', 'numeroProfesores', 'periodo',
        'nombreCurso', 'fecha_I', 'fecha_F', 'hora_I', 'hora_F', 'objetivoEvento', 'tipo_FDoAP', 'tipo_actividad',
        'carrera_dirigido', 'observaciones', 'id_jefe', 'obs', 'aceptado', 'modalidad', 'facilitador_externo'
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

    public function carrera(): HasOne
    {
        return $this->hasOne(Carrera::class, 'id', 'carrera_dirigido');
    }

    public function jefe_academico(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_jefe', 'docente_id');
    }

    public function jefe(){
        return $this->belongsTo(Docente::class, 'id_jefe');
    }

}
