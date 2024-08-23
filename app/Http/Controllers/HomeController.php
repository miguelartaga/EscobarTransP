<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Camiones;


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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // Obtén los camiones para mostrar en el home
       $camiones = Camiones::paginate(10); // Ajusta la cantidad de camiones por página según sea necesario

        return view('home', compact('camiones'));
    }

}
