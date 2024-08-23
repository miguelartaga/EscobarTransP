<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento;
use App\Models\Camiones;
use App\Models\TipoMantenimiento;
use Illuminate\Http\Request;

class MantenimientoController extends Controller
{
    public function index()
    {
        $mantenimientos = Mantenimiento::with('tipoMantenimiento')->paginate(10);
        return view('mantenimiento.index', compact('mantenimientos'))
            ->with('i', (request()->input('page', 1) - 1) * $mantenimientos->perPage());
    }


    public function create()
    {
        $camiones = Camiones::all(); // Obtenemos todos los camiones
        $tiposMantenimientos = TipoMantenimiento::all(); // Obtenemos todos los tipos de mantenimiento

        return view('mantenimiento.create', compact('camiones', 'tiposMantenimientos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'camion_id' => 'required|exists:camiones,numero_placa',
            'tipo_mantenimiento_id' => 'required|exists:tipo_mantenimiento,id',
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        $mantenimiento = new Mantenimiento();
        $mantenimiento->camion_id = $request->input('camion_id');
        $mantenimiento->tipo_mantenimiento_id = $request->input('tipo_mantenimiento_id');
        $mantenimiento->fecha = $request->input('fecha');
        $mantenimiento->descripcion = $request->input('descripcion');
        $mantenimiento->save();

        // Verificar si el tipo de mantenimiento es 'cambio de aceite'
        $tipoMantenimiento = TipoMantenimiento::find($request->input('tipo_mantenimiento_id'));
        if ($tipoMantenimiento && $tipoMantenimiento->nombre === 'cambio de aceite') {
            // Actualizar el campo proximo_cambio_aceite del camión a 0
            $camion = Camiones::where('numero_placa', $request->input('camion_id'))->first();
            if ($camion) {
                $camion->proximo_cambio_aceite = 0;
                $camion->save();
            }
        }

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento creado exitosamente.');
    }


    public function show($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        return view('mantenimiento.show', compact('mantenimiento'));
    }

    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $camiones = Camiones::all();
        $tiposMantenimientos = TipoMantenimiento::all();

        return view('mantenimiento.edit', compact('mantenimiento', 'camiones', 'tiposMantenimientos'));
    }





    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->update([
            'fecha' => $request->input('fecha'),
            'descripcion' => $request->input('descripcion'),
        ]);

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $mantenimiento->delete();

        return redirect()->route('mantenimientos.index')->with('success', 'Mantenimiento eliminado exitosamente.');
    }

}
