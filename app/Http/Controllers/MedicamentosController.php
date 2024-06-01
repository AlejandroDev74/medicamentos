<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentosController extends Controller
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
    public function registrar_medicamento()
    {
        $hoy = date("Y-m-d");

        $datos = request();
        DB::table('medicamentos')
        ->insert(['med_producto' => $datos['producto'],
                'med_registro_sanitario' => $datos['registro'],
                'med_proveedor' => $datos['proveedor'],
                'med_fecha_expedicion' => $datos['expedicion'],
                'med_fecha_vencimiento' => $datos['vencimiento'],
                'med_cantidad' => $datos['cantidad'],
                'med_descripcion' => $datos['descripcion'],
                'med_estado' => 1,
                'med_unidad' => $datos['unidad'],
                'med_componentes' => $datos['componentes'],
                'med_fecha_ult_mod' => $hoy,
                'med_fecha_registro' => $hoy]);

                session_start();
                $_SESSION["mensaje"] = 1;

        return redirect('medicamentos');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function medicamentos(Request $request)
    {
        $data = DB::table('medicamentos')->get();
        $data1 = DB::table('proveedores')->get();

        return view('medicamentos', ['data' => $data, 'data1' => $data1]);
    }

    public function actualizar_medicamento()    {
        $hoy = date("Y-m-d");

        $datos = request()->except('_token');
        DB::table('medicamentos')
            ->where('med_id', '=', $datos['id'])
            ->update(['med_producto' => $datos['producto'],
            'med_registro_sanitario' => $datos['registro'],
            'med_fecha_expedicion' => $datos['fecha_expedicion'],
            'med_fecha_vencimiento' => $datos['fecha_vencimiento'],
            'med_cantidad' => $datos['cantidad'],
            'med_descripcion' => $datos['descripcion'],
            'med_componentes' => $datos['componentes'],
            'med_fecha_ult_mod' => $hoy]);

            session_start();
            $_SESSION["mensaje"] = 2;
            
        return redirect('medicamentos');
    }

    //MÉTODO PARA LA FUNCIONALIDAD DE INHABILITACIÓN DE MEDICAMENTOS
    public function inhabilitacion_medicamento()
    {
        $datos = request()->except('_token');
        DB::table('medicamentos')
        ->where('med_id', '=', $datos['id3'])
        ->update([
            'med_estado' => 2
        ]);

        session_start();
        $_SESSION["mensaje"] = 2;

        return redirect('medicamentos');
    }

     //MÉTODO PARA LA FUNCIONALIDAD DE HABILITACIÓN DE MEDICAMENTOS
     public function habilitacion_medicamento()
     {
        $datos = request()->except('_token');
        DB::table('medicamentos')
        ->where('med_id', '=', $datos['id2'])
        ->update([
            'med_estado' => 1
        ]);
 
        session_start();
        $_SESSION["mensaje"] = 2;
        
         return redirect('medicamentos');
     }

}
