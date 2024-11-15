<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $inventarios = Inventario::with('producto')->get();
        return view('inventarios.index', compact('inventarios'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('inventarios.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:0',
        ]);

        Inventario::create($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario creado exitosamente.');
    }

    public function show(Inventario $inventario)
    {
        return view('inventarios.show', compact('inventario'));
    }

    public function edit(Inventario $inventario)
    {
        $productos = Producto::all();
        return view('inventarios.edit', compact('inventario', 'productos'));
    }

    public function update(Request $request, Inventario $inventario)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id_producto',
            'cantidad' => 'required|integer|min:0',
        ]);

        $inventario->update($request->all());

        return redirect()->route('inventarios.index')->with('success', 'Inventario actualizado exitosamente.');
    }

    public function destroy(Inventario $inventario)
    {
        $inventario->delete();
        return redirect()->route('inventarios.index')->with('success', 'Inventario eliminado exitosamente.');
    }
}