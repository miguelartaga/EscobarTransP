<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    static $rules = [
        'camion_id' => 'required',
        'fecha' => 'required',
        'descripcion' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['camion_id', 'fecha', 'descripcion', 'tipo_mantenimiento_id']; // Asegúrate de que el campo 'tipo_mantenimiento_id' esté en el fillable

    /**
     * Relación con el modelo Camiones.
     */
    public function camion()
    {
        return $this->belongsTo('App\Models\Camiones', 'camion_id', 'numero_placa');
    }

    /**
     * Relación con el modelo TipoMantenimiento.
     */
    public function tipoMantenimiento()
    {
        return $this->belongsTo(TipoMantenimiento::class, 'tipo_mantenimiento_id');
    }
}
