<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;
use App\Models\Camiones;
use App\Models\Chofere;
use App\Models\Destino;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;


/**
 * Class RutaController
 * @package App\Http\Controllers
 */
class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutas = Ruta::where('is_realizada', false)->paginate(10);

        return view('ruta.index', compact('rutas'))
            ->with('i', (request()->input('page', 1) - 1) * $rutas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camiones = Camiones::pluck('numero_placa', 'numero_placa'); // Para mostrar la placa en el formulario
        $choferes = Chofere::pluck('nombre', 'id');

        // Obtenemos los destinos junto con los nombres de los lugares de inicio y final
        $destinos = Destino::with(['lugarInicio', 'lugarFinal'])->get()->mapWithKeys(function ($destino) {
            return [$destino->id => $destino->lugarInicio->nombre . ' -> ' . $destino->lugarFinal->nombre];
        });

        return view('ruta.create', compact('camiones', 'choferes', 'destinos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'destino_id' => 'required|exists:destinos,id',
            'camion_numero_placa' => 'required|exists:camiones,numero_placa',
            'chofer_id' => 'required|exists:choferes,id',
            'fecha_fin' => 'required|date',
            'codigo_de_pago' => 'required|string',
            'carga' => 'required|string',
            'peso' => 'required|string',
            'precio' => 'required|string',
            'precio_total' => 'required|string',
        ]);

        // Crear una nueva instancia de Ruta
        $ruta = new Ruta();
        $ruta->destino_id = $request->destino_id;
        $ruta->camion_numero_placa = $request->camion_numero_placa;
        $ruta->chofer_id = $request->chofer_id;
        $ruta->fecha_fin = $request->fecha_fin;
        $ruta->codigo_de_pago = $request->codigo_de_pago;
        $ruta->carga = $request->carga;
        $ruta->peso = $request->peso;
        $ruta->precio = $request->precio;
        $ruta->precio_total = $request->precio_total;
        $ruta->is_realizada = false;
        $ruta->save();

        // Obtener el kilometraje del destino
        $destino = Destino::find($request->destino_id);
        if ($destino) {
            // Obtener el camión y actualizar su kilometraje
            $camion = Camiones::where('numero_placa', $request->camion_numero_placa)->first();
            if ($camion) {
                $camion->proximo_cambio_aceite += $destino->kilometros; // Actualizar con el kilometraje del destino
                $camion->save();
            }
        }

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('rutas.index')->with('success', 'Ruta creada con éxito.');
    }





    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rutas = Ruta::where('is_realizada', true)->paginate(10);

        return view('ruta.show', compact('rutas'))
            ->with('i', (request()->input('page', 1) - 1) * $rutas->perPage());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruta = Ruta::findOrFail($id);
        $camiones = Camiones::pluck('numero_placa', 'numero_placa'); // Para mostrar la placa en el formulario
        $choferes = Chofere::pluck('nombre', 'id');

        // Obtenemos los destinos junto con los nombres de los lugares de inicio y final
        $destinos = Destino::with(['lugarInicio', 'lugarFinal'])->get()->mapWithKeys(function ($destino) {
            return [$destino->id => $destino->lugarInicio->nombre . ' -> ' . $destino->lugarFinal->nombre];
        });

        return view('ruta.edit', compact('ruta', 'camiones', 'choferes', 'destinos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Ruta $ruta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruta $ruta)
    {
        request()->validate(Ruta::$rules);

        $ruta->update($request->all());

        return redirect()->route('ruta.index')
            ->with('success', 'Ruta updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        // Buscar la ruta por ID
        $ruta = Ruta::find($id);

        // Verificar si se encontró la ruta
        if (!$ruta) {
            // Si no se encuentra, redirigir con un mensaje de error
            return redirect()->route('rutas.index')
                ->with('error', 'Ruta no encontrada.');
        }

        // Si se encuentra, eliminarla
        $ruta->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('rutas.index')
            ->with('success', 'Ruta eliminada con éxito.');
    }
    public function generateInvoice(Request $request)
    {
        // Validar que se seleccionaron rutas y se ingresó el nombre del cliente
        $request->validate([
            'rutas' => 'required|array',
            'cliente_nombre' => 'required|string',
        ]);

        $clienteNombre = $request->input('cliente_nombre');
        $rutasSeleccionadas = Ruta::whereIn('id', $request->input('rutas'))->get();

        if ($rutasSeleccionadas->isEmpty()) {
            return redirect()->back()->with('error', 'No se seleccionaron rutas válidas.');
        }

        // Crear el comprador (Buyer)
        $customer = new Buyer([
            'name' => "Nombre de: {$clienteNombre}",
        ]);

        // Crear el vendedor (Seller)
        $seller = new Buyer([
            'name' => 'TRANS ESCOBAR',
        ]);

        // Crear los items de la factura
        $items = [];
        $subtotal = 0;
        foreach ($rutasSeleccionadas as $ruta) {
            $itemDescription = "Ruta #{$ruta->id}\n" .
                               "Camión: {$ruta->camion_numero_placa}\n" .
                               "Destino Id: {$ruta->destino_id}\n" .
                               "Fecha: {$ruta->fecha_fin}\n" .
                               "Carga: {$ruta->carga}\n" .
                               "Código de Boleta: {$ruta->codigo_de_pago}\n" .
                               "peso: {$ruta->peso}";

            $items[] = (new InvoiceItem())
                ->title($itemDescription)
                ->quantity($ruta->peso)
                ->pricePerUnit($ruta->precio);

            $subtotal += $ruta->peso * $ruta->precio;
        }

        // Calcular los impuestos
        $impuesto1 = $subtotal * -0.03; // 3%
        $iva = $subtotal * -0.13; // 13%
        $iue = $subtotal * -0.02; // 2%
        $ahr = $subtotal * -0.02; // 2%

        // Añadir los impuestos como items
        $items[] = (new InvoiceItem())->title('Impuesto 1 (3%)')->pricePerUnit($impuesto1);
        $items[] = (new InvoiceItem())->title('IVA (13%)')->pricePerUnit($iva);
        $items[] = (new InvoiceItem())->title('IUE (2%)')->pricePerUnit($iue);
        $items[] = (new InvoiceItem())->title('AHR (2%)')->pricePerUnit($ahr);

        // Convertir el total en palabras
        function convertirNumeroEnPalabras($numero)
        {
            $f = new \NumberFormatter("es", \NumberFormatter::SPELLOUT);
            return ucfirst($f->format($numero));
        }

        $totalEnPalabras = convertirNumeroEnPalabras($subtotal) . ' Bs';

        // Crear la factura
        $invoice = Invoice::make()
            ->buyer($customer)
            ->seller($seller)
            ->addItems($items)
            ->filename('Factura_Rutas_' . time())
            ->currencySymbol('Bs')
            ->currencyCode('Bs')
            ->logo(public_path('vendor/invoices/sample-logo.jpg'))
            ->notes("Monto en palabras: $totalEnPalabras");


        // Devolver la factura como un archivo PDF
        return $invoice->stream();
    }
    public function updateStatus($id)
    {
        $ruta = Ruta::find($id);
        if ($ruta) {
            $ruta->is_realizada = !$ruta->is_realizada; // Alterna el estado
            $ruta->save();

            return redirect()->back(); // Redirige de nuevo a la misma página
        }

        return redirect()->back()->withErrors('Error al actualizar el estado.');
    }


}
