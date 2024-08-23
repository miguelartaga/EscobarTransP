<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Camiones
 *
 * @property $numero_placa
 * @property $modelo
 * @property $año
 * @property $descripcion
 * @property $proximo_cambio_aceite
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Camiones extends Model
{
    // Nombre de la tabla
    protected $table = 'camiones';

    // Establecer la clave primaria
    protected $primaryKey = 'numero_placa';

    // Desactivar auto-incremento
    public $incrementing = false;

    // Tipo de la clave primaria
    protected $keyType = 'string';

    // Reglas de validación
    static $rules = [
        'numero_placa' => 'required',
        'modelo' => 'required',
        'año' => 'required',
        'descripcion'=> 'required',
        'proximo_cambio_aceite' => 'required|integer',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numero_placa', 'modelo', 'año', 'descripcion', 'proximo_cambio_aceite'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mantenimientos()
    {
        return $this->hasMany('App\Models\Mantenimiento', 'camion_id', 'numero_placa');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rutas()
    {
        return $this->hasMany('App\Models\Ruta', 'camion_id', 'numero_placa');
    }
}
