<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productosDestacados = Producto::where('estado', 'activo')->inRandomOrder()->take(6)->get();
        return view('home', compact('productosDestacados'));
    }
}