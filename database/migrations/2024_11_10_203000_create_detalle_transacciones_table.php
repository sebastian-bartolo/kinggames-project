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
        Schema::create('detalle_transacciones', function (Blueprint $table) {
            $table->id('id_detalle_transaccion');
            $table->foreignId('id_transaccion')->constrained('transacciones', 'id_transaccion');
            $table->foreignId('id_producto')->constrained('productos', 'id_producto');
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
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
        Schema::dropIfExists('detalle_transacciones');
    }
};
