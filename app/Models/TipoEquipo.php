<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEquipo extends Model
{
    protected $fillable = [
        'tipo_equipo',
        'marca',
        'modelo',
        'numero_serie',
        'color',
        'accesorios',
        'numero_inventario',
        'valor',
    ];
}
