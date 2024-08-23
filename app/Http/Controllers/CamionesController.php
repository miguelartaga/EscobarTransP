<?php

namespace App\Http\Controllers;

use App\Models\Camiones;
use Illuminate\Http\Request;

class CamionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camiones = Camiones::paginate(10); // Paginación de 10 elementos por página

        return view('camiones.index', compact('camiones'))
            ->with('i', (request()->input('page', 1) - 1) * $camiones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camion = new Camiones(); // Crear una nueva instancia de Camiones
        return view('camiones.create', compact('camion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate(Camiones::$rules);

        // Crear un nuevo camión con los datos proporcionados
        Camiones::create($request->all());

        // Redirigir a la lista de camiones con un mensaje de éxito
        return redirect()->route('camiones.index')
            ->with('success', 'Camión creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $numero_placa
     * @return \Illuminate\Http\Response
     */
    public function show($numero_placa)
    {
        // Buscar el camión por numero_placa
        $camion = Camiones::where('numero_placa', $numero_placa)->firstOrFail();

        // Mostrar la vista con los detalles del camión
        return view('camiones.show', compact('camion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $numero_placa
     * @return \Illuminate\Http\Response
     */
    public function edit($numero_placa)
    {
        // Buscar el camión por numero_placa
        $camion = Camiones::where('numero_placa', $numero_placa)->firstOrFail();
        return view('camiones.edit', compact('camion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $numero_placa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $numero_placa)
    {
        // Validar los datos
        $request->validate(Camiones::$rules);

        // Buscar el camión por numero_placa
        $camion = Camiones::where('numero_placa', $numero_placa)->firstOrFail();

        // Actualizar los datos del camión
        $camion->update($request->all());

        // Redirigir a la lista de camiones con un mensaje de éxito
        return redirect()->route('camiones.index')
            ->with('success', 'Camión actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $numero_placa
     * @return \Illuminate\Http\Response
     */
    public function destroy($numero_placa)
    {
        // Buscar y eliminar el camión por numero_placa
        Camiones::where('numero_placa', $numero_placa)->delete();

        // Redirigir a la lista de camiones con un mensaje de éxito
        return redirect()->route('camiones.index')
            ->with('success', 'Camión eliminado exitosamente.');
    }
}
