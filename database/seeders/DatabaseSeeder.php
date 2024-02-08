<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin_id = DB::table('usuarios')->insertGetId([
            'primer_nombre' => 'Ivan',
            'segundo_nombre' => 'Alejandro',
            'primer_apellido' => 'Mera',
            'segundo_apellido' => 'Maldonado',
            'email' => 'imera92@gmail.com',
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        $admin_cargo_id = DB::table('cargos')->insertGetId([
            'nombre' => 'Administrador',
            'estado' => true,
            'usuario_creacion' => $admin_id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        $fe_dev_id = DB::table('cargos')->insertGetId([
            'nombre' => 'Desarrollador Frontend',
            'estado' => true,
            'usuario_creacion' => $admin_id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);
        
        $be_dev_id = DB::table('cargos')->insertGetId([
            'nombre' => 'Desarrollador Backend',
            'estado' => true,
            'usuario_creacion' => $admin_id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        $dpto_gerencia_id = DB::table('departamentos')->insertGetId([
            'nombre' => 'Gerencia',
            'estado' => true,
            'usuario_creacion' => $admin_id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        $dpto_desarrollo_id = DB::table('departamentos')->insertGetId([
            'nombre' => 'Desarrollo',
            'estado' => true,
            'usuario_creacion' => $admin_id,
            'created_at' => DB::raw('CURRENT_TIMESTAMP')
        ]);

        DB::table('usuarios')
            ->where('id', 1)
            ->update([
                'departamento_id' => $dpto_gerencia_id,
                'cargo_id' => $admin_cargo_id
            ]);
        
        DB::table('usuarios')->insert([
            [
                'primer_nombre' => 'Walter',
                'primer_apellido' => 'White',
                'email' => 'wwhite@gmail.com',
                'departamento_id' => $dpto_desarrollo_id,
                'cargo_id' => $be_dev_id,
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ],
            [
                'primer_nombre' => 'Saul',
                'primer_apellido' => 'Goodman',
                'email' => 'sgoodman@gmail.com',
                'departamento_id' => $dpto_desarrollo_id,
                'cargo_id' => $fe_dev_id,
                'created_at' => DB::raw('CURRENT_TIMESTAMP')
            ]
        ]);
    }
}
