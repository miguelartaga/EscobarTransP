<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Lugar;
use Illuminate\Http\Request;

class DestinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Cargar destinos con las relaciones lugarInicio y lugarFinal
        $destinos = Destino::with('lugarInicio', 'lugarFinal')->paginate(10);

        return view('destino.index', compact('destinos'))
            ->with('i', (request()->input('page', 1) - 1) * $destinos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Obtener listas de lugares para seleccionar en los formularios
        $lugares = Lugar::all()->pluck('nombre', 'id');
        return view('destino.create', compact('lugares'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'lugar_inicio_id' => 'required|exists:lugares,id',
            'lugar_final_id' => 'required|exists:lugares,id',
            'kilometros' => 'required|numeric',
        ]);

        Destino::create($request->all());

        return redirect()->route('destinos.index')
            ->with('success', 'Destino creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\View\View
     */
    public function show(Destino $destino)
    {
        // Cargar la relación para mostrar los nombres en lugar de los IDs
        $destino->load('lugarInicio', 'lugarFinal');

        return view('destino.show', compact('destino'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\View\View
     */
    public function edit(Destino $destino)
    {
        $lugares = Lugar::all()->pluck('nombre', 'id');
        return view('destino.edit', compact('destino', 'lugares'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Destino $destino)
    {
        $request->validate([
            'lugar_inicio_id' => 'required|exists:lugares,id',
            'lugar_final_id' => 'required|exists:lugares,id',
            'kilometros' => 'required|numeric',
        ]);

        $destino->update($request->all());

        return redirect()->route('destinos.index')
            ->with('success', 'Destino actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destino  $destino
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Destino $destino)
    {
        $destino->delete();

        return redirect()->route('destinos.index')
            ->with('success', 'Destino eliminado exitosamente.');
    }
}
