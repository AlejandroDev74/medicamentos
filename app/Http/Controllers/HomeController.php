<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('medicamentos')
        ->where('med_estado', '<>', 2)
        ->get();
        return view('catalogo', ['data' => $data]);
    }

    public function estadisticas()
    {
        $hoy = date("Y-m-d");
        $fecha_dias = date("Y-m-d",strtotime($hoy."- 15 days")); 

        $data = DB::table('users')->count();

        $data1 = DB::table('proveedores')->count();

        $data2 = DB::table('medicamentos')->sum('med_cantidad');

        $data3 = DB::table('medicamentos')
        ->where('med_cantidad', '<=', 10)
        ->get();

        $data4 = DB::table('medicamentos')
        ->where('med_fecha_vencimiento', '>=', $fecha_dias)
        ->get();

        return view('estadisticas', ['data' => $data, 'data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4]);
    }

    public function contrasena()
    {
        return view('contrasena');
    }

}
