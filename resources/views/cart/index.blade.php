@extends('layouts.app')

@section('title', 'Carrito de compras - Tienda de Videojuegos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Carrito de compras</h1>
    </div>
</div>

@if(count($cartItems) > 0)
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $item->producto->imagen) }}" alt="{{ $item->producto->nombre }}" class="img-thumbnail" width="50">
                                {{ $item->producto->nombre }}
                            </td>
                            <td>${{ number_format($item->producto->precio, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item->producto) }}" method="POST" class="form-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" max="{{ $item->producto->inventario->cantidad }}" class="form-control form-control-sm" style="width: 60px;">
                                    <button type="submit" class="btn btn-sm btn-secondary ml-2">Actualizar</button>
                                </form>
                            </td>
                            <td>${{ number_format($item->producto->precio * $item->cantidad, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->producto) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Resumen del pedido</h5>
                    <p class="card-text"><strong>Total:</strong> ${{ number_format($total, 2) }}</p>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block">Procesar compra</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-12">
            <p>No hay productos en el carrito.</p>
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Ver productos</a>
        </div>
    </div>
@endif
@endsection