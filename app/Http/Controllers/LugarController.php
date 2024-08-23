<?php
namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;

/**
 * Class LugarController
 * @package App\Http\Controllers
 */
class LugarController extends Controller

{

    public function index()
    {
        $lugares = Lugar::paginate(10);

        return view('lugar.index', compact('lugares'))
            ->with('i', (request()->input('page', 1) - 1) * $lugares->perPage());
    }

    public function create()
    {
        $lugar = new Lugar();
        return view('lugar.create', compact('lugar'));
    }

    public function store(Request $request)
    {
        $request->validate(Lugar::$rules);
        $lugar = Lugar::create($request->all());

        return redirect()->route('lugares.index')
            ->with('success', 'Lugar created successfully.');
    }

    public function show($id)
    {
        $lugar = Lugar::find($id);

        return view('lugar.show', compact('lugar'));
    }

    public function edit($id)
    {
        $lugar = Lugar::find($id);

        return view('lugar.edit', compact('lugar'));
    }

    public function update(Request $request, Lugar $lugar)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Actualizar el modelo con los datos del formulario
        $lugar->update($request->only('nombre'));

        // Redirigir con un mensaje de éxito
        return redirect()->route('lugares.index')
            ->with('success', 'Lugar actualizado exitosamente.');
    }





    public function destroy($id)
    {
        $lugar = Lugar::find($id)->delete();

        return redirect()->route('lugares.index')
            ->with('success', 'Lugar deleted successfully');
    }
}
