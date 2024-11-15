<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    protected $primaryKey = 'id_transaccion';

    protected $fillable = [
        'id_usuario', 'id_proveedor', 'tipo', 'fecha_transaccion', 'total'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function detalleTransacciones()
    {
        return $this->hasMany(DetalleTransaccion::class, 'id_transaccion');
    }
}