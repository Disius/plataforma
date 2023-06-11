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
    public function index()
    {

        $detecciones = DeteccionNecesidades::with(['carrera', 'deteccion_facilitador'])
        ->where('aceptado', '=', 0)->where('id_jefe', auth()->user()->docente_id)->get();

        $carrera = Carrera::all();
        return Inertia::render('academicos/DeteccionNecesidades', [
            'detecciones' => $detecciones,
            'carer' => $carrera,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * creation of deteccion de necesidades
     */
    public function create(): \Inertia\Response
    {
        $docentes = Docente::select('nombre_completo', 'id')->get();
        $carrera = Carrera::where('departamento_id', auth()->user()->departamento_id)->select('nameCarrera', 'id', 'departamento_id')->get();
        $departamento = Departamento::all();
        return Inertia::render('academicos/operaciones_deteccion/DeteccionForm', [
            'carrera' => $carrera,
            'docentes' => $docentes,
            'departamento' => $departamento
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
            'id_jefe' => 'required',
            'modalidad' => ['required'],
            'facilitador_externo' => ['required']
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
            'modalidad' => $request->modalidad,
            'facilitador_externo' =>  $request->facilitador_externo
        ]);

        $deteccion->save();

        $deteccion->deteccion_facilitador()->sync($request->input('facilitadores', []));

        return redirect()->route('index.necesity');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $detecciones = DeteccionNecesidades::with(['carrera', 'deteccion_facilitador'])
            ->where('aceptado', 1)->where('id_jefe', auth()->user()->docente_id)->get();
        return Inertia::render('academicos/operaciones_deteccion/AllRegistros', [
            'detecciones' => $detecciones
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Inertia\Response
    {
        $carrera = Carrera::all();
        $deteccionID = DeteccionNecesidades::find($id);

        $relationDocente = $deteccionID->deteccion_facilitador;
        return Inertia::render('academicos/operaciones_deteccion/EditNecesidad', [
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

        $deteccion->asignaturaFA = $request->asignaturaFA;
        $deteccion->contenidosTM = $request->contenidosTM;
        $deteccion->numeroProfesores = $request->numeroProfesores;
        $deteccion->periodo = $request->periodo;
        $deteccion->nombreCurso = $request->nombreCurso;
        $deteccion->fecha_I = $request->fecha_I;
        $deteccion->fecha_F = $request->fecha_F;
        $deteccion->hora_I = $request->periodo;
        $deteccion->hora_F = $request->hora_F;
        $deteccion->tipo_FDoAP = $request->tipo_FDoAP;
        $deteccion->tipo_actividad = $request->tipo_actividad;
        $deteccion->objetivoEvento = $request->objetivoEvento;
        $deteccion->carrera_dirigido = $request->carrera_dirigido;
        $deteccion->id_jefe = $request->id_jefe;
        $deteccion->modalidad = $request->modalidad;
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

        $cursos = DeteccionNecesidades::with(['carrera', 'deteccion_facilitador'])->where('aceptado', '=', 1)
            ->where('id_jefe', auth()->user()->docente_id)->get();

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
