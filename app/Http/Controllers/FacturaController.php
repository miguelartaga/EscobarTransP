<?php
use Barryvdh\DomPDF\Facade\Pdf;

class FacturaController extends Controller
{
    public function generarPDF($factura_id)
    {
        // Obtener los datos de la factura desde la base de datos
        $factura = Factura::find($factura_id);

        // Pasar los datos a la vista
        $pdf = Pdf::loadView('facturas.pdf', ['factura' => $factura]);

        // Descargar el PDF
        return $pdf->download('factura.pdf');
    }
}
