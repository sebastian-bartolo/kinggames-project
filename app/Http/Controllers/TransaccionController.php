<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Usuario;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\DetalleTransaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaccionController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::with(['usuario', 'proveedor'])->get();
        return view('transacciones.index', compact('transacciones'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('transacciones.create', compact('usuarios', 'proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:venta,compra',
            'id_usuario' => 'required_if:tipo,venta|exists:usuarios,id_usuario',
            'id_proveedor' => 'required_if:tipo,compra|exists:proveedores,id_proveedor',
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $transaccion = new Transaccion();
            $transaccion->tipo = $request->tipo;
            $transaccion->id_usuario = $request->id_usuario;
            $transaccion->id_proveedor = $request->id_proveedor;
            $transaccion->total = 0;
            $transaccion->save();

            $total = 0;

            foreach ($request->productos as $producto) {
                $detalle = new DetalleTransaccion();
                $detalle->id_transaccion = $transaccion->id_transaccion;
                $detalle->id_producto = $producto['id_producto'];
                $detalle->cantidad = $producto['cantidad'];
                $detalle->precio_unitario = $producto['precio_unitario'];
                $detalle->save();

                $total += $detalle->cantidad * $detalle->precio_unitario;

                // Actualizar inventario
                $inventario = Producto::find($producto['id_producto'])->inventario;
                if ($transaccion->tipo == 'venta') $inventario->cantidad -= $producto['cantidad'];
                else
                    $inventario->cantidad += $producto['cantidad'];
                $inventario->save();
            }

            $transaccion->total = $total;
            $transaccion->save();

            DB::commit();

            return redirect()->route('transacciones.index')->with('success', 'Transacción creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al crear la transacción: ' . $e->getMessage()]);
        }
    }

    public function show(Transaccion $transaccion)
    {
        $transaccion->load(['detalleTransacciones.producto', 'usuario', 'proveedor']);
        return view('transacciones.show', compact('transaccion'));
    }

    public function destroy(Transaccion $transaccion)
    {
        DB::beginTransaction();

        try {
            foreach ($transaccion->detalleTransacciones as $detalle) {
                $inventario = $detalle->producto->inventario;
                if ($transaccion->tipo == 'venta')
                    $inventario->cantidad += $detalle->cantidad;
                else
                    $inventario->cantidad -= $detalle->cantidad;
                $inventario->save();
            }

            $transaccion->delete();

            DB::commit();

            return redirect()->route('transacciones.index')->with('success', 'Transacción eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al eliminar la transacción: ' . $e->getMessage()]);
        }
    }
}