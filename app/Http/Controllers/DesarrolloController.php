<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DesarrolloController extends Controller
{
    public function parametros(){
        $carrera = Carrera::with('departamento')->get();
        $departamento = Departamento::select('nameDepartamento', 'id')->get();
        return Inertia::render('desarrollo/Parametros', [
            'carreras' => $carrera,
            'departamento' => $departamento
        ]);
    }

    public function update(Request $request, $id){
        $carrera = Carrera::find($id);

        $carrera->nameCarrera = $request->nameCarrera;
        $carrera->jefe_departamento = $request->jefe_departamento;
        $carrera->presidente_academia = $request->presidente_academia;
        $carrera->departamento_id = $request->departamento_id;

        $carrera->save();

        return redirect()->route('parametros');

    }
}
