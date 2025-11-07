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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProveedor');
            $table->foreign('idProveedor')->references('id')->on('proveedores');
            $table->string('codigoProducto', 12);
            $table->string('nombreProducto', 50);
            $table->string('descripcionProducto', 250);
            $table->bigInteger('cantidadProducto');
            $table->float('costoProducto', 8, 2);
            $table->float('gananciaProducto', 8, 2);
            $table->float('precioProducto', 8, 2);
            $table->string('imageProducto', 10000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
