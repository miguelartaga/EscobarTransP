<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Chofere
 *
 * @property $id
 * @property $nombre
 * @property $licencia
 * @property $carnet_identidad
 * @property $direccion
 * @property $numero_referencia
 * @property $numero_referencia_segundo
 * @property $created_at
 * @property $updated_at
 *
 * @property CamionChofer[] $camionChofers
 * @property Ruta[] $rutas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Chofere extends Model
{
    /**
     * Validation rules for the model.
     *
     * @var array
     */
    static $rules = [
        'nombre' => 'required|string',
        'licencia' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'carnet_identidad' => 'required|string',
        'direccion' => 'required|string',
        'numero_referencia' => 'required|string',
        'numero_referencia_segundo' => 'required|string',
    ];

    /**
     * The number of models to return per page.
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'licencia', 'carnet_identidad', 'direccion', 'numero_referencia','numero_referencia_segundo'];

    /**
     * Get the camionChofers associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function camionChofers()
    {
        return $this->hasMany('App\Models\CamionChofer', 'chofer_id', 'id');
    }

    /**
     * Get the rutas associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rutas()
    {
        return $this->hasMany('App\Models\Ruta', 'chofer_id', 'id');
    }
}
