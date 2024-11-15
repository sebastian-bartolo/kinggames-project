<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleTransaccion extends Model
{
    protected $primaryKey = 'id_detalle_transaccion';

    protected $fillable = [
        'id_transaccion', 'id_producto', 'cantidad', 'precio_unitario'
    ];

    public function transaccion()
    {
        return $this->belongsTo(Transaccion::class, 'id_transaccion');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}