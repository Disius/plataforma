<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Curso;
use App\Models\Departamento;
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
        $departamento = Departamento::all();
        return Inertia::render('academicos/deteccionCRUD/DeteccionForm', [
            'carrera' => $carrera,
            'docentes' => $docentes,
            'departamento' => $departamento
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

        $relationDocente = $deteccionID->deteccion_facilitador;
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

        $deteccion = DeteccionNecesidades::find($id);

        if($request->input('asignaturaFA') != null){
            $deteccion->asignaturaFA = $request->asignaturaFA;
        }
        if($request->input('contenidosTM') != null){
            $deteccion->contenidosTM = $request->contenidosTM;
        }
        if($request->input('numeroProfesores') != null){
            $deteccion->numeroProfesores = $request->numeroProfesores;
        }
        if($request->input('periodo') != null){
            $deteccion->periodo = $request->periodo;
        }
        if($request->input('nombreCurso') != null){
            $deteccion->nombreCurso = $request->nombreCurso;
        }
        if($request->input('fecha_I') != null){
            $deteccion->fecha_I = $request->fecha_I;
        }
        if($request->input('fecha_F') != null){
            $deteccion->fecha_F = $request->fecha_F;
        }
        if($request->input('hora_I') != null){
            $deteccion->hora_I = $request->periodo;
        }
        if($request->input('hora_F') != null){
            $deteccion->hora_F = $request->hora_F;
        }
        if($request->input('tipo_FDoAP') != null){
            $deteccion->tipo_FDoAP = $request->tipo_FDoAP;
        }
        if($request->input('tipo_actividad') != null){
            $deteccion->tipo_actividad = $request->tipo_actividad;
        }
        if($request->input('objetivoEvento') != null){
            $deteccion->objetivoEvento = $request->objetivoEvento;
        }
        if($request->input('carrera_dirigido') != null){
            $deteccion->carrera_dirigido = $request->carrera_dirigido;
        }
        if($request->input('id_jefe') != null){
            $deteccion->id_jefe = $request->id_jefe;
        }
        if($request->input('facilitadores') != null){
            $deteccion->deteccion_facilitador()->sync($request->input('facilitadores', []));
        }

        $deteccion->save();

        return redirect()->route('index.necesity');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cursoIndex(){
        $cursos = DB::table('cursos')
            ->join('carreras', 'carreras.id', '=', 'cursos.dirigido')
            ->select('cursos.*', 'carreras.nameCarrera AS nombreCarrera')
            ->get();

        return Inertia::render('academicos/curso/Curso', [
            'cursos' => $cursos
        ]);
    }

    public function indexDocente(){

        $docentesBase = DB::table('docente')->where('tipo_plaza', '=', 1)
                                                ->get();
        $docentes = DB::table('docente')
            ->join('tipo_plaza' , 'tipo_plaza.id', '=', 'docente.tipo_plaza')
            ->select('docente.*', 'tipo_plaza.nombre AS plazaNombre')
            ->get();
        return Inertia::render('academicos/docente/Docente', [
            'docentes' => $docentes,
            'docentesBase' => $docentesBase,
        ]);
    }
}
