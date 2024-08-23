<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Destino
 *
 * @property int $id
 * @property int $lugar_inicio_id
 * @property int $lugar_final_id
 * @property int $kilometros
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property Lugar $lugarInicio
 * @property Lugar $lugarFinal
 * @property Ruta[] $rutas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Destino extends Model
{
    static $rules = [
        'lugar_inicio_id' => 'required|exists:lugares,id',
        'lugar_final_id' => 'required|exists:lugares,id',
        'kilometros' => 'required|numeric',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['lugar_inicio_id', 'lugar_final_id', 'kilometros'];

    /**
     * Get the lugarInicio for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lugarInicio()
    {
        return $this->belongsTo('App\Models\Lugar', 'lugar_inicio_id');
    }

    /**
     * Get the lugarFinal for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lugarFinal()
    {
        return $this->belongsTo('App\Models\Lugar', 'lugar_final_id');
    }

    /**
     * Get the rutas for this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rutas()
    {
        return $this->hasMany('App\Models\Ruta', 'destino_id');
    }
}
