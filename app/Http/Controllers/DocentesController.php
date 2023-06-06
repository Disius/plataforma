<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('docentes/cursos/Curso');
    }
    public function indexMyInfo()
    {
        $carrera = Carrera::select('nameCarrera', 'id')->get();
        $departamento = Departamento::select('nameDepartamento', 'id')->get();
        $tipoPlaza = DB::table('tipo_plaza')->select('id', 'nombre')->get();
        $puesto = DB::table('puesto')->select('id', 'nombre')->get();

        $auth = Auth::user()->docente_id;

        $docente = Docente::where('docente.id', $auth)
            ->join('carreras', 'carreras.id', '=', 'docente.carrera_id')
            ->join('tipo_plaza', 'tipo_plaza.id', '=', 'docente.tipo_plaza')
            ->join('puesto', 'puesto.id', '=', 'docente.id_puesto')
            ->join('departamento', 'departamento.id', '=', 'docente.departamento_id')
            ->select('docente.*', 'tipo_plaza.nombre AS namePlaza', 'carreras.nameCarrera', 'puesto.nombre AS namePuesto', 'departamento.nameDepartamento')
            ->first();


        return Inertia::render('docentes/infoCrud/MyInfo', [
            'docente' => $docente,
            'carrera' => $carrera,
            'departamento' => $departamento,
            'tipo_plaza' => $tipoPlaza,
            'puesto' => $puesto
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
    public function store(Request $request)
    {
        $docente = Docente::create([
            'rfc' => $request->rfc,
            'curp' => $request->curp,
            'nombre' => $request->nombre,
            'apellidoPat' => $request->apellidoPat,
            'apellidoMat' => $request->apellidoMat,
            'sexo' => $request->sexo,
            'telefono' => $request->telefono,
            'carrera_id' => $request->carrera_id,
            'id_puesto' => $request->id_puesto,
            'tipo_plaza' => $request->tipo_plaza,
            'departamento_id' => $request->departamento_id,
            'user_id' => $request->id,
        ]);

        $docente->save();


        User::where('id', $request->id)->update([
            'docente_id' => $docente->id,
        ]);


        return redirect()->route('index.docenteInfo');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->email != null){
            User::where('id', $request->id)->update([
                'email' => $request->email
            ]);
        }
        $deteccion = Docente::find($id);

        $deteccion->rfc = $request->rfc;
        $deteccion->curp = $request->curp;
        $deteccion->nombre = $request->nombre;
        $deteccion->apellidoPat = $request->apellidoPat;
        $deteccion->apellidoMat = $request->apellidoMat;
        $deteccion->sexo = $request->sexo;
        $deteccion->telefono = $request->telefono;
        $deteccion->carrera_id = $request->carrera_id;
        $deteccion->id_puesto = $request->id_puesto;
        $deteccion->tipo_plaza = $request->tipo_plaza;
        $deteccion->departamento_id = $request->departamento_id;
        $deteccion->user_id = $request->user_id;

        $deteccion->save();

        return redirect()->route('index.docenteInfo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
