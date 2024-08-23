<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lugar
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @property Destino[] $destinos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Lugar extends Model
{
    protected $table = 'lugares';
    static $rules = [
        'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinosFinal()
    {
        return $this->hasMany('App\Models\Destino', 'lugar_final_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinosInicio()
    {
        return $this->hasMany('App\Models\Destino', 'lugar_inicio_id', 'id');
    }
}
