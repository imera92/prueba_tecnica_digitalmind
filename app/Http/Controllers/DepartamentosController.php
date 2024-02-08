<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentosController extends Controller
{
    /**
     * Devuelve una lista con todos los departamentos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::orderBy('created_at', 'desc')->get();

        return $departamentos;
    }
}
