@extends('layouts.app')

@section('title', 'Productos - Tienda de Videojuegos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Productos</h1>
        </div>
    </div>

<div class="row">
    @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                    <p class="card-text"><strong>Precio: ${{ number_format($producto->precio, 2) }}</strong></p>
                    <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn btn-primary">Ver detalles</a>
                    <form action="{{ route('cart.add', $producto) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="row">
    <div class="col-md-12">
        {{ $productos->links() }}
    </div>
</div>
@endsection