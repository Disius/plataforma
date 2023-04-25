<?php

namespace App\Http\Controllers;

use App\Models\DeteccionNecesidades;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoordinacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $necesidades = DeteccionNecesidades::with('deteccion_facilitador')
            ->orderBy('id', 'desc')
            ->where('aceptado', '=', 0)
            ->join('docente', 'docente.id', '=', 'deteccion_necesidades.id_jefe')
            ->join('carreras', 'carreras.id', '=', 'deteccion_necesidades.carrera_dirigido')
            ->select("deteccion_necesidades.*", "docente.nombre_completo AS nombreJefe", "carreras.nameCarrera")
            ->get();
        $necesidadesAceptadas = DeteccionNecesidades::with('deteccion_facilitador')
            ->orderBy('id', 'desc')
            ->where('aceptado', 1)
            ->join('docente', 'docente.id', '=', 'deteccion_necesidades.id_jefe')
            ->join('carreras', 'carreras.id', '=', 'deteccion_necesidades.carrera_dirigido')
            ->select("deteccion_necesidades.*", "docente.nombre_completo AS nombreJefe", "carreras.nameCarrera")
            ->get();

        return Inertia::render('desarrollo/coordinacion/Necesidades', [
            'detecciones' => $necesidades,
            'deteccionesAceptadas' => $necesidadesAceptadas
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

    public function existObservaciones(DeteccionNecesidades $detecciones)
    {
        return response()->json([
            'response' => $detecciones->isDirty()
        ]);

    }
}