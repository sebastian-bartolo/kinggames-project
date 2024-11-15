<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\DetalleTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Verificar si hay productos en el carrito
        if (\Cart::isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {
            // Crear la transacción
            $transaccion = new Transaccion();
            $transaccion->id_usuario = auth()->id();
            $transaccion->tipo = 'venta';
            $transaccion->total = \Cart::getTotal();
            $transaccion->save();

            // Crear los detalles de la transacción
            foreach (\Cart::getContent() as $item) {
                $detalle = new DetalleTransaccion();
                $detalle->id_transaccion = $transaccion->id_transaccion;
                $detalle->id_producto = $item->id;
                $detalle->cantidad = $item->quantity;
                $detalle->precio_unitario = $item->price;
                $detalle->save();

                // Actualizar el inventario
                $producto = $item->associatedModel;
                $producto->inventario->cantidad -= $item->quantity;
                $producto->inventario->save();
            }

            DB::commit();

            // Limpiar el carrito
            \Cart::clear();

            return redirect()->route('home')->with('success', 'Compra realizada con éxito. Gracias por su compra.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Error al procesar la compra. Por favor, inténtelo de nuevo.');
        }
    }
}