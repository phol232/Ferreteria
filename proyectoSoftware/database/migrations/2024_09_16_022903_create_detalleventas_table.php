<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalleventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idVenta');
            $table->foreign('idVenta')->references('id')->on('ventas');
            $table->unsignedBigInteger('idProducto');
            $table->foreign('idProducto')->references('id')->on('productos');
            $table->bigInteger('cantidadDetalleVenta');
            $table->float('subtotalDetalleVenta');
            $table->float('totalDetalleVenta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleventas');
    }
};
