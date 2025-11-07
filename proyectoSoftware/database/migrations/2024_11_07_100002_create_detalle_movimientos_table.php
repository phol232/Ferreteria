<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idMovimiento')->constrained('movimientos_inventario')->onDelete('cascade');
            $table->string('codigoProducto', 12);
            $table->string('nombreProducto', 50);
            $table->string('descripcionProducto', 250);
            $table->integer('cantidad');
            $table->float('costoProducto');
            $table->float('gananciaProducto');
            $table->float('precioProducto');
            $table->string('imageProducto', 10000)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_movimientos');
    }
};
