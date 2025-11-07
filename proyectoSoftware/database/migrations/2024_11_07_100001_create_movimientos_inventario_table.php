<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProveedor')->constrained('proveedores');
            $table->string('tipoMovimiento', 20)->default('entrada'); // entrada, salida, ajuste
            $table->text('descripcion')->nullable();
            $table->date('fechaMovimiento');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos_inventario');
    }
};
