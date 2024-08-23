<?php

namespace App\Http\Controllers;

use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;

/**
 * Class TipoMantenimientoController
 * @package App\Http\Controllers
 */
class TipoMantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cambiar el nombre de la variable a $tipoMantenimientos
        $tipoMantenimientos = TipoMantenimiento::paginate(10);

        return view('tipo-mantenimiento.index', compact('tipoMantenimientos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoMantenimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoMantenimiento = new TipoMantenimiento();
        return view('tipo-mantenimiento.create', compact('tipoMantenimiento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define tus reglas de validación en el modelo TipoMantenimiento
        $request->validate(TipoMantenimiento::$rules);

        $tipoMantenimiento = TipoMantenimiento::create($request->all());

        // Si tienes un array de IDs de mantenimientos seleccionados:
        if ($request->has('mantenimiento_ids')) {
            $tipoMantenimiento->mantenimientos()->sync($request->input('mantenimiento_ids'));
        }

        return redirect()->route('tipo-mantenimientos.index')  // Cambiado aquí
            ->with('success', 'TipoMantenimiento created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoMantenimiento = TipoMantenimiento::findOrFail($id);
        return view('tipo-mantenimiento.show', compact('tipoMantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoMantenimiento = TipoMantenimiento::findOrFail($id);
        return view('tipo-mantenimiento.edit', compact('tipoMantenimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoMantenimiento $tipoMantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMantenimiento $tipoMantenimiento)
    {
        $request->validate(TipoMantenimiento::$rules);

        $tipoMantenimiento->update($request->all());

        // Si tienes un array de IDs de mantenimientos seleccionados:
        if ($request->has('mantenimiento_ids')) {
            $tipoMantenimiento->mantenimientos()->sync($request->input('mantenimiento_ids'));
        }

        return redirect()->route('tipo-mantenimientos.index')  // Cambiado aquí
            ->with('success', 'TipoMantenimiento updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        TipoMantenimiento::findOrFail($id)->delete();

        return redirect()->route('tipo-mantenimientos.index')  // Cambiado aquí
            ->with('success', 'TipoMantenimiento deleted successfully');
    }
}
