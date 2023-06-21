<?php

namespace App\Http\Controllers;

use App\Models\DeteccionNecesidades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CoordinacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detecciones = DeteccionNecesidades::with(['carrera', 'deteccion_facilitador', 'jefe'])
        ->where('aceptado', '=', 0)->get();

        return Inertia::render('desarrollo/coordinacion/Necesidades', [
            'detection' => $detecciones,
        ]);
    }

    public function allRegistros() {
        $detecciones = DeteccionNecesidades::with(['carrera', 'deteccion_facilitador'])
        ->where('aceptado', '=', 1)->get();

        return Inertia::render('desarrollo/coordinacion/TodasNecesidades', [
            'detection' => $detecciones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'aceptado' => ['required']
        ]);


        $detecciones = DeteccionNecesidades::find($id);

        $detecciones->aceptado = $request->aceptado;

        $detecciones->save();

        return redirect()->route('index.necesidad');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'observaciones' => ['required']
        ]);

        DeteccionNecesidades::where('id', $id)->update([
            'observaciones' => $request->observaciones,
            'obs' => 1
        ]);

        return redirect()->route('index.necesidad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function indexCursos(): \Inertia\Response
    {
        $cursos = DeteccionNecesidades::with(['carrera', 'deteccion_facilitador'])
        ->where('aceptado', '=', 1)->get();
        return Inertia::render('desarrollo/coordinacion/curso/Curso', [
            'cursos' => $cursos
        ]);
    }

    public function notificationTest(): \Illuminate\Database\Eloquent\Collection|array|null
    {
        if (auth()->user() != null){
            return User::with(['notifications'])->where('id', auth()->user()->id)->get();
        } else {
            return null;
        }
    }


}
