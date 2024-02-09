<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Departamento;
use App\Models\Cargo;
use View;

class CoreController extends Controller
{
    public function index() {
        $usuarios = Usuario::all();
        $departamentos = Departamento::all();
        $cargos = Cargo::all();

        return view('crud_usuarios', [
            'usuarios' => $usuarios,
            'departamentos' => $departamentos,
            'cargos' => $cargos
        ]);
    }
}
