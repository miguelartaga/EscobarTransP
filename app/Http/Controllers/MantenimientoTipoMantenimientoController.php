<?php

namespace App\Http\Controllers;

use App\Models\MantenimientoTipoMantenimiento;
use Illuminate\Http\Request;

/**
 * Class MantenimientoTipoMantenimientoController
 * @package App\Http\Controllers
 */
class MantenimientoTipoMantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientoTipoMantenimientos = MantenimientoTipoMantenimiento::paginate();

        return view('mantenimiento-tipo-mantenimiento.index', compact('mantenimientoTipoMantenimientos'));
    }

    public function create()
    {
        $mantenimientoTipoMantenimiento = new MantenimientoTipoMantenimiento();
        return view('mantenimiento-tipo-mantenimiento.create', compact('mantenimientoTipoMantenimiento'));
    }

    public function store(Request $request)
    {
        request()->validate(MantenimientoTipoMantenimiento::$rules);

        MantenimientoTipoMantenimiento::create($request->all());

        return redirect()->route('mantenimiento-tipo-mantenimiento.index')
            ->with('success', 'Mantenimiento Tipo Mantenimiento created successfully.');
    }

    public function show($id)
    {
        $mantenimientoTipoMantenimiento = MantenimientoTipoMantenimiento::find($id);

        return view('mantenimiento-tipo-mantenimiento.show', compact('mantenimientoTipoMantenimiento'));
    }

    public function edit($id)
    {
        $mantenimientoTipoMantenimiento = MantenimientoTipoMantenimiento::find($id);

        return view('mantenimiento-tipo-mantenimiento.edit', compact('mantenimientoTipoMantenimiento'));
    }

    public function update(Request $request, MantenimientoTipoMantenimiento $mantenimientoTipoMantenimiento)
    {
        request()->validate(MantenimientoTipoMantenimiento::$rules);

        $mantenimientoTipoMantenimiento->update($request->all());

        return redirect()->route('mantenimiento-tipo-mantenimiento.index')
            ->with('success', 'Mantenimiento Tipo Mantenimiento updated successfully');
    }

    public function destroy($id)
    {
        MantenimientoTipoMantenimiento::find($id)->delete();

        return redirect()->route('mantenimiento-tipo-mantenimiento.index')
            ->with('success', 'Mantenimiento Tipo Mantenimiento deleted successfully');
    }
}
