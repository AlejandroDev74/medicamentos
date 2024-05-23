<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function registrar_proveedor()
    {
        $hoy = date("Y-m-d");

        $datos = request();
        DB::table('proveedores')
        ->insert(['pro_nombre' => $datos['nombre'],
                'pro_correo' => $datos['correo'],
                'pro_telefono' => $datos['telefono'],
                'pro_estado' => 1,
                'pro_fecha_registro' => $hoy]);

                session_start();
                $_SESSION["mensaje"] = 1;

        return redirect('proveedores');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function proveedores(Request $request)
    {
        $data = DB::table('proveedores')->get();
        return view('proveedores', ['data' => $data]);
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
    public function store(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function actualizar_proveedor()    {
        $hoy = date("Y-m-d");

        $datos = request()->except('_token');
        DB::table('proveedores')
            ->where('pro_id', '=', $datos['id'])
            ->update(['pro_nombre' => $datos['nombre'],
                'pro_correo' => $datos['correo'],
                'pro_telefono' => $datos['telefono']
            ]);

            session_start();
            $_SESSION["mensaje"] = 2;
            
        return redirect('proveedores');
    }

    //MÉTODO PARA LA FUNCIONALIDAD DE INHABILITACIÓN DE PROVEEDORES 29/07/2023
    public function inhabilitacion_proveedor()
    {
        $datos = request()->except('_token');
        DB::table('proveedores')
        ->where('pro_id', '=', $datos['id3'])
        ->update([
            'pro_estado' => 2
        ]);

        session_start();
        $_SESSION["mensaje"] = 2;

        return redirect('proveedores');
    }

     //MÉTODO PARA LA FUNCIONALIDAD DE HABILITACIÓN DE PROVEEDORES 29/07/2023
     public function habilitacion_proveedor()
     {
        $datos = request()->except('_token');
        DB::table('proveedores')
        ->where('pro_id', '=', $datos['id2'])
        ->update([
            'pro_estado' => 1
        ]);
 
        session_start();
        $_SESSION["mensaje"] = 2;
        
         return redirect('proveedores');
     }

}
