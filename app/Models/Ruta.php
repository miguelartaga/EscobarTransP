<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ruta
 *
 * @property $id
 * @property $camion_numero_placa
 * @property $chofer_id
 * @property $destino_id
 * @property $fecha_fin
 * @property $codigo_de_pago
 * @property $peso
 * @property $precio
 * @property $created_at
 * @property $updated_at
 * @property $is_realizada
 *
 * @property Camione $camione
 * @property Chofere $chofere
 * @property Destino $destino
 * @property Factura[] $facturas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Ruta extends Model
{
    static $rules = [
        'camion_numero_placa' => 'required',
        'chofer_id' => 'required',
        'destino_id' => 'required',
        'fecha_fin' => 'required',
        'codigo_de_pago' => 'required',
        'carga' => 'required',
        'precio' => 'required',
        'peso' => 'required',
        'precio_total' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'camion_numero_placa', 'chofer_id', 'destino_id', 'fecha_fin',
        'codigo_de_pago', 'carga', 'peso', 'precio', 'precio_total', 'is_realizada'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function camion()
    {
        return $this->belongsTo('App\Models\Camiones', 'camion_numero_placa', 'numero_placa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function chofere()
    {
        return $this->hasOne('App\Models\Chofere', 'id', 'chofer_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function destino()
    {
        return $this->hasOne('App\Models\Destino', 'id', 'destino_id');
    }

}
