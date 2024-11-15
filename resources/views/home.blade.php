@extends('layouts.app')

@section('title', 'Inicio - Tienda de Videojuegos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Bienvenido a nuestra Tienda de Videojuegos</h1>
        <p class="lead">Descubre los mejores juegos y consolas al mejor precio.</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h2>Productos destacados</h2>
    </div>
</div>

<div class="row">
    @foreach($productosDestacados as $producto)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">{{ Str::limit($producto->descripcion, 100) }}</p>
                    <p class="card-text"><strong>Precio: ${{ number_format($producto->precio, 2) }}</strong></p>
                    <a href="{{ route('productos.show', $producto) }}" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection