<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nombre', 'contacto', 'telefono', 'email', 'direccion'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'id_proveedor');
    }
}