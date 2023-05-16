<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Departamento;
use App\Models\Docente;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use function GuzzleHttp\Promise\all;

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
            'email' => $request->email,
            'telefono' => $request->telefono,
            'carrera_id' => $request->carrera_id,
            'id_puesto' => $request->id_puesto,
            'tipo_plaza' => $request->tipo_plaza,
            'departamento_id' => $request->departamento_id,
            'user_id' => $request->id
        ]);

        $docente->save();

        $docente = Docente::where('user_id', $request->id)->select('id')->first();
        \App\Models\User::where('id', $request->id)->update([
            'docente_id' => $docente->id
        ]);

        return redirect()->route('index.docenteInfo');
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
        $input = $request->except(['created_at', 'updated_at']);
        Docente::where('id', $id)->update($input);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
