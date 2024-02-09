<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departamento;
use App\Models\Cargo;

class Usuario extends Model
{
    public function departamento()
    {
    	return $this->belongsTo(Departamento::class);
    }

    public function cargo()
    {
    	return $this->belongsTo(Cargo::class);
    }
}
