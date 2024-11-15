<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('nombre', 100);
            $table->foreignId('id_categoria')->constrained('categorias', 'id_categoria');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->foreignId('id_proveedor')->constrained('proveedores', 'id_proveedor');
            $table->string('imagen', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
