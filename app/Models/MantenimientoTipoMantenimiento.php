<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MantenimientoTipoMantenimiento
 *
 * @property $id
 * @property $mantenimiento_id
 * @property $tipo_mantenimiento_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Mantenimiento $mantenimiento
 * @property TipoMantenimiento $tipoMantenimiento
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class MantenimientoTipoMantenimiento extends Model
{
    protected $table = 'mantenimiento_tipo_mantenimiento';

    static $rules = [
        'mantenimiento_id' => 'required',
        'tipo_mantenimiento_id' => 'required',
    ];

    protected $fillable = ['mantenimiento_id', 'tipo_mantenimiento_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mantenimiento()
    {
        return $this->belongsTo('App\Models\Mantenimiento', 'mantenimiento_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoMantenimiento()
    {
        return $this->belongsTo('App\Models\TipoMantenimiento', 'tipo_mantenimiento_id');
    }
}
