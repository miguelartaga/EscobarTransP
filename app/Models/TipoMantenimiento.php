<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMantenimiento extends Model
{
    protected $table = 'tipo_mantenimiento'; // Asegúrate de que esta línea esté presente

    static $rules = [
        'nombre' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['nombre'];

    public function mantenimientos()
    {
        return $this->belongsToMany(Mantenimiento::class, 'mantenimiento_tipo_mantenimiento', 'tipo_mantenimiento_id', 'mantenimiento_id');
    }
}
