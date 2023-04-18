<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\DeteccionNecesidades;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AcademicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Inertia\Response
    {
        $deteccionesAll = DeteccionNecesidades::with('deteccion_facilitador')->orderBy('id', 'desc')
            ->join('docente', 'docente.id', '=', 'deteccion_necesidades.id_jefe')
            ->join('carreras', 'carreras.id', '=', 'deteccion_necesidades.carrera_dirigido')
            ->select("deteccion_necesidades.*", "docente.nombre_completo", "carreras.nameCarrera")
            ->get();
        $carrera = Carrera::all();
        return Inertia::render('academicos/DeteccionNecesidades', [
            'deteccionesall' => $deteccionesAll,
            'carer' => $carrera
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * creation of deteccion de necesidades
     */
    public function create(): \Inertia\Response
    {
        $docentes = Docente::select('nombre_completo', 'id')->get();
        $carrera = Carrera::select('nameCarrera', 'id', 'departamento_id')->get();
        return Inertia::render('academicos/deteccionCRUD/DeteccionForm', [
            'carrera' => $carrera,
            'docentes' => $docentes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'AsignaturasFA' => 'required',
            'ContenidoTFA' => 'required',
            'Numprofesores' => 'required',
            'periodo' => 'required',
            'nombreCT' => 'required',
            'fecha_I' => 'required',
            'fecha_F' => 'required',
            'hora_I' => 'required',
            'hora_F' => 'required',
            'objetivo' => 'required',
            'tipo' => 'required',
            'tipo_act' => 'required',
            'dirigido' => 'required',
            'id_jefe' => 'required'
        ]);

        $deteccion = DeteccionNecesidades::create([
            'asignaturaFA' => $request->AsignaturasFA,
            'contenidosTM' => $request->ContenidoTFA,
            'numeroProfesores' => $request->Numprofesores,
            'periodo' => $request->periodo,
            'nombreCurso' => $request->nombreCT,
            'fecha_I' => $request->fecha_I,
            'fecha_F' => $request->fecha_F,
            'hora_I' => $request->hora_I,
            'hora_F' => $request->hora_F,
            'objetivoEvento' => $request->objetivo,
            'tipo_FDoAP' => $request->tipo,
            'tipo_actividad' => $request->tipo_act,
            'carrera_dirigido' => $request->dirigido,
            'id_jefe' => $request->id_jefe,
            'aceptado' => 0,
        ]);

        $deteccion->save();

        $deteccion->deteccion_facilitador()->sync($request->input('facilitadores', []));

        return redirect()->route('index.necesity');
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
    public function edit(string $id): \Inertia\Response
    {
        $carrera = Carrera::all();
        $deteccionID = DeteccionNecesidades::find($id);

        $relationDocente = DeteccionNecesidades::with('deteccion_facilitador')
            ->first();
        return Inertia::render('academicos/deteccionCRUD/EditNecesidad', [
            'deteccionSelect' => $deteccionID,
            'carrera' => $carrera,
            'relation' => $relationDocente,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'asignaturaFA' => 'required',
            'contenidosTM' => 'required',
            'numeroProfesores' => 'required',
            'periodo' => 'required',
            'nombreCurso' => 'required',
            'fecha_I' => 'required',
            'fecha_F' => 'required',
            'hora_I' => 'required',
            'hora_F' => 'required',
            'objetivoEvento' => 'required',
            'tipo_FDoAP' => 'required',
            'tipo_actividad' => 'required',
            'carrera_dirigido' => 'required',
            'id_jefe' => 'required'
        ]);

        DeteccionNecesidades::where('id', $id)->update([
            'asignaturaFA' => $request->asignaturaFA,
            'contenidosTM' => $request->contenidosTM,
            'numeroProfesores' => $request->numeroProfesores,
            'periodo' => $request->periodo,
            'nombreCurso' => $request->nombreCurso,
            'fecha_I' => $request->fecha_I,
            'fecha_F' => $request->fecha_F,
            'hora_I' => $request->hora_I,
            'hora_F' => $request->hora_F,
            'objetivoEvento' => $request->objetivoEvento,
            'tipo_FDoAP' => $request->tipo_FDoAP,
            'tipo_actividad' => $request->tipo_actividad,
            'carrera_dirigido' => $request->carrera_dirigido,
            'id_jefe' => $request->id_jefe,
            'aceptado' => 0
        ]);

        echo "Deteccion Actualizada con exito";

        return redirect()->route('index.necesity');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
