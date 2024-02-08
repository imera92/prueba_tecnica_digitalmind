<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargosController extends Controller
{
    /**
     * Devuelve una lista con todos los cargos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargos = Cargo::orderBy('created_at', 'desc')->get();

        return $cargos;
    }
}
