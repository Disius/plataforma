<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Docente;
use Illuminate\Http\Request;
use Ramsey\Collection\Collection;

class RegistrosController extends Controller
{
    public function docente(): \Illuminate\Database\Eloquent\Collection
    {
        return Docente::all();
    }
    public function carer(): \Illuminate\Database\Eloquent\Collection
    {
        return Carrera::all();
    }
}
