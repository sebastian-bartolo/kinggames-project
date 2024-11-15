<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre', 'id_categoria', 'descripcion', 'precio', 'estado', 'id_proveedor', 'imagen'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function inventario()
    {
        return $this->hasOne(Inventario::class, 'id_producto');
    }

    public function detalleTransacciones()
    {
        return $this->hasMany(DetalleTransaccion::class, 'id_producto');
    }
}