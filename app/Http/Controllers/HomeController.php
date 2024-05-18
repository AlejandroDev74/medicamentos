<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('catalogo');
    }

    public function usuarios()
    {
        return view('usuarios');
    }

    public function medicamentos()
    {
        return view('medicamentos');
    }

    public function estadisticas()
    {
        return view('estadisticas');
    }

    public function perfiles()
    {
        return view('perfiles');
    }

    public function proveedores()
    {
        return view('proveedores');
    }
}
