<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Usuario;
use App\Models\Departamento;
use App\Models\Cargo;

class UsuariosController extends Controller
{
    /**
     * Devuelve una lista con todos los usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::orderBy('created_at', 'desc')->get();

        return $usuarios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos_obligatorios = [
            'primer_nombre',
            'primer_apellido',
            'email',
            'departamento_id',
            'cargo_id'
        ];

        if ($request->has($campos_obligatorios)) {
            $departamento = Departamento::find($request->input('departamento_id'));
            $cargo = Cargo::find($request->input('cargo_id'));

            if ($departamento == null) {
                return response([
                    'error' => 'El departamento especificado no existe'
                ], 422)
                ->header('Content-Type', 'application/json');
            }

            if ($cargo == null) {
                return response([
                    'error' => 'El cargo especificado no existe'
                ], 422)
                ->header('Content-Type', 'application/json');
            }

            $nuevo_usuario = new Usuario();
            $nuevo_usuario->primer_nombre = $request->input('primer_nombre');
            $nuevo_usuario->segundo_nombre = $request->input('segundo_nombre');
            $nuevo_usuario->primer_apellido = $request->input('primer_apellido');
            $nuevo_usuario->segundo_apellido = $request->input('segundo_apellido');
            $nuevo_usuario->email = $request->input('email');
            $nuevo_usuario->departamento_id = $departamento->id;
            $nuevo_usuario->cargo_id = $cargo->id;
            $nuevo_usuario->save();

            return $nuevo_usuario;
        }

        $campos_faltantes = [];
        for ($i = 0; $i < count($campos_obligatorios); $i++) {
            if (!$request->has($campos_obligatorios[$i])) {
                $campos_faltantes[] = $campos_obligatorios[$i];
            }
        }

        return response([
            'error' => 'Faltan datos para crear el usuario',
            'data' => $campos_faltantes
        ], 422)
        ->header('Content-Type', 'application/json');
    }

    /**
     * Devuelve el usuario especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::where('id', $id)->first();

        if ($usuario == null)  {
            return response([
                'error' => 'Usuario no encontrado'
            ], 404)
            ->header('Content-Type', 'application/json');
        }

        return $usuario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        

        if ($usuario == null)  {
            return response([
                'error' => 'Usuario no encontrado'
            ], 404)
            ->header('Content-Type', 'application/json');
        }

        if ($request->input('departamento_id')) {
            $departamento = Departamento::find($request->input('departamento_id'));
            if ($departamento == null) {
                return response([
                    'error' => 'El departamento especificado no existe'
                ], 422)
                ->header('Content-Type', 'application/json');
            }
        }

        if ($request->input('cargo_id')) {
            $cargo = Cargo::find($request->input('cargo_id'));
            if ($cargo == null) {
                return response([
                    'error' => 'El cargo especificado no existe'
                ], 422)
                ->header('Content-Type', 'application/json');
            }
        }

        $usuario->primer_nombre = $request->input('primer_nombre') ? $request->input('primer_nombre') : $usuario->primer_nombre;
        $usuario->segundo_nombre = $request->has('segundo_nombre') ? $request->input('segundo_nombre') : $usuario->segundo_nombre;
        $usuario->primer_apellido = $request->input('primer_apellido') ? $request->input('primer_apellido') : $usuario->primer_apellido;
        $usuario->segundo_apellido = $request->has('segundo_apellido') ? $request->input('segundo_apellido') : $usuario->segundo_apellido;
        $usuario->email = $request->input('email') ? $request->input('email') : $usuario->email;
        $usuario->departamento_id = $request->input('departamento_id') ? $request->input('departamento_id') : $usuario->departamento_id;
        $usuario->cargo_id = $request->input('cargo_id') ? $request->input('cargo_id') : $usuario->cargo_id;
        $usuario->save();

        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if ($usuario == null)  {
            return response([
                'error' => 'Usuario no encontrado'
            ], 404)
            ->header('Content-Type', 'application/json');
        }

        $usuario->delete();

        return response([
            'error' => null
        ], 200)
        ->header('Content-Type', 'application/json');
    }
}
