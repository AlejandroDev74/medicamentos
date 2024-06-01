<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenesController extends Controller
{
    public function registrar_orden()
    {
        $datos = request();
        $hoy = date("Y-m-d");

        $cantidad = $this->obtener_cantidades($datos['id3']);
        $cantidadmed = $cantidad - $datos['cantidad3'];

        $this->actualizar_cantidades($datos['id3'], $cantidadmed);

        DB::table('ordenes')
        ->insert(['id_producto' => $datos['id3'],
                'ord_producto' => $datos['nombre3'],
                'ord_cantidad' => $datos['cantidad3'],
                'ord_fecha_ult_mod' => $hoy,
                'ord_fecha_registro' => $hoy]);

                session_start();
                $_SESSION["mensaje"] = 1;

        return redirect('ordenes');
    }

    public function ordenes(Request $request)
    {
        $data = DB::table('ordenes')->get();
        return view('ordenes', ['data' => $data]);
    }

    public function obtener_cantidades($id)
    {
        $data = DB::table('medicamentos')
        ->where('med_id', '=', $id)
        ->get('med_cantidad');

        foreach($data as $d){
            $cantidad = $d->med_cantidad;
        }
        return $cantidad;
    }

    public function actualizar_cantidades($id, $cantidad)
    {
        $datos = request()->except('_token');
        DB::table('medicamentos')
        ->where('med_id', '=', $datos['id3'])
        ->update([
            'med_cantidad' => $cantidad
        ]);
    }
}
