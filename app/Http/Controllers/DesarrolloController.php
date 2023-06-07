<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesarrolloController extends Controller
{
    public function parametros(){
        $carrera = Carrera::all();
        return Inertia::render('desarrollo/Parametros', [
            'carreras' => $carrera
        ]);
    }
}
