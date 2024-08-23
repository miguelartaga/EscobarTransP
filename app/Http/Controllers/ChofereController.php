<?php

namespace App\Http\Controllers;

use App\Models\Chofere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChofereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $choferes = Chofere::paginate(10);

        return view('chofere.index', compact('choferes'))
            ->with('i', (request()->input('page', 1) - 1) * $choferes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chofere = new Chofere();
        return view('chofere.create', compact('chofere'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ci' => 'required|string|unique:choferes,ci',
            'nombre' => 'required|string',
            'licencia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'direccion' => 'required|string',
            'numero_referencia' => 'required|string',
            'numero_referencia_segundo' => 'required|string',
        ]);

        $chofere = new Chofere();
        $chofere->ci = $request->input('ci');
        $chofere->nombre = $request->input('nombre');

        // Manejo de la imagen de licencia
        if ($request->hasFile('licencia')) {
            $file = $request->file('licencia');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/licencias', $filename); // Guarda el archivo en storage/app/public/licencias
            $chofere->licencia = $filename;
        }

        $chofere->direccion = $request->input('direccion');
        $chofere->numero_referencia = $request->input('numero_referencia');
        $chofere->numero_referencia_segundo = $request->input('numero_referencia_segundo');
        $chofere->save();

        return redirect()->route('choferes.index')
            ->with('success', 'Chofere created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chofere = Chofere::find($id);

        return view('chofere.show', compact('chofere'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chofere = Chofere::find($id);

        return view('chofere.edit', compact('chofere'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Chofere $chofere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chofere $chofere)
    {
        $request->validate([
            'ci' => 'required|string|unique:choferes,ci,' . $chofere->id,
            'nombre' => 'required|string',
            'licencia' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
            'direccion' => 'required|string',
            'numero_referencia' => 'required|string',
            'numero_referencia_segundo' => 'required|string',
        ]);

        $chofere->ci = $request->input('ci');
        $chofere->nombre = $request->input('nombre');

        // Manejo de la imagen de licencia si se actualiza
        if ($request->hasFile('licencia')) {
            // Eliminar la antigua imagen
            if ($chofere->licencia) {
                Storage::delete('public/licencias/' . $chofere->licencia);
            }

            $file = $request->file('licencia');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/licencias', $filename);
            $chofere->licencia = $filename;
        }

        $chofere->direccion = $request->input('direccion');
        $chofere->numero_referencia = $request->input('numero_referencia');
        $chofere->numero_referencia_segundo = $request->input('numero_referencia_segundo');
        $chofere->save();

        return redirect()->route('choferes.index')
            ->with('success', 'Chofere updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $chofere = Chofere::find($id);

        // Eliminar la imagen asociada
        if ($chofere->licencia) {
            Storage::delete('public/licencias/' . $chofere->licencia);
        }

        $chofere->delete();

        return redirect()->route('choferes.index')
            ->with('success', 'Chofere deleted successfully');
    }
}
