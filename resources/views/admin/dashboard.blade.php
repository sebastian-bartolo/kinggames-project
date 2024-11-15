@extends('layouts.app')

@section('title', 'Panel de Administración - Tienda de Videojuegos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="mb-4">Panel de Administración</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text">Gestionar usuarios del sistema.</p>
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Ir a Usuarios</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Productos</h5>
                <p class="card-text">Gestionar productos de la tienda.</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary">Ir a Productos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Inventario</h5>
                <p class="card-text">Gestionar el inventario de productos.</p>
                <a href="{{ route('inventarios.index') }}" class="btn btn-primary">Ir a Inventario</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Proveedores</h5>
                <p class="card-text">Gestionar proveedores de productos.</p>
                <a href="{{ route('proveedores.index') }}" class="btn btn-primary">Ir a Proveedores</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categorías</h5>
                <p class="card-text">Gestionar categorías de productos.</p>
                <a href="{{ route('categorias.index') }}" class="btn btn-primary">Ir a Categorías</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Transacciones</h5>
                <p class="card-text">Ver y gestionar transacciones de venta y compra.</p>
                <a href="{{ route('transacciones.index') }}" class="btn btn-primary">Ir a Transacciones</a>
            </div>
        </div>
    </div>
</div>
@endsection