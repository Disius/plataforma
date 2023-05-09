<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Docente;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Inertia\Inertia;
use Nette\Schema\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): \Inertia\Response
    {
        $docentes = DB::table('docente')
            ->join('tipo_plaza' , 'tipo_plaza.id', '=', 'docente.tipo_plaza')
            ->select('docente.*', 'tipo_plaza.nombre AS plazaNombre')
            ->get();

        $departamento = Departamento::all();

        return Inertia::render('Auth/Register', [
            'role' => $request->role,
            'docentes' => $docentes,
            'departamento' => $departamento
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [],
            'email' => [],
            'password' => [],
            'roleUser' => [],
            'id_docente' => [],
            'departamento_id' => [],
        ]);

        $docente = Docente::where('id', $request->id_docente)->first();

        if(empty($docente)){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'docente_id' => $request->id_docente,
                'role' => $request->roleUser,
                'departamento_id' => $request->departamento_id,
            ]);
        }else{
            $user = User::create([
                'name' => $docente->nombre,
                'email' => $docente->email,
                'password' => Hash::make($request->password),
                'docente_id' => $request->id_docente,
                'departamento_id' => $docente->departamento_id,
                'role' => $request->roleUser
            ]);
        }
        $rol = DB::table('roles')->where('id', '=', $request->roleUser)->first();
        $user->assignRole($rol->name);
        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }

}
