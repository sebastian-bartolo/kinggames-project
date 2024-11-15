@extends('layouts.app')

@section('title', $producto->nombre . ' - Tienda de Videojuegos')

@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
    </div>
    <div class="col-md-6">
        <h1>{{ $producto->nombre }}</h1>
        <p class="lead">{{ $producto->descripcion }}</p>
        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre_categoria }}</p>
        <p><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($producto->estado) }}</p>
        <form action="{{ route('cart.add', $producto) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="{{ $producto->inventario->cantidad }}">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Agregar al carrito</button>
        </form>
    </div>
</div>
@endsection