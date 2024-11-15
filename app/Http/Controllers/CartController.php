<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = \Cart::getContent();
        $total = \Cart::getTotal();
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Producto $producto)
    {
        \Cart::add([
            'id' => $producto->id_producto,
            'name' => $producto->nombre,
            'price' => $producto->precio,
            'quantity' => $request->cantidad ?? 1,
            'attributes' => [
                'imagen' => $producto->imagen,
            ],
            'associatedModel' => $producto
        ]);

        return redirect()->route('cart.index')->with('success', 'Producto agregado al carrito.');
    }

    public function update(Request $request, Producto $producto)
    {
        \Cart::update($producto->id_producto, [
            'quantity' => [
                'relative' => false,
                'value' => $request->cantidad
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Carrito actualizado.');
    }

    public function remove(Producto $producto)
    {
        \Cart::remove($producto->id_producto);
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }
}