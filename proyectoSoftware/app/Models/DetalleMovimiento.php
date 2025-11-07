<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleMovimiento extends Model
{
    use HasFactory;

    protected $table = 'detalle_movimientos';

    protected $fillable = [
        'idMovimiento',
        'codigoProducto',
        'nombreProducto',
        'descripcionProducto',
        'cantidad',
        'costoProducto',
        'gananciaProducto',
        'precioProducto',
        'imageProducto'
    ];

    public function movimiento()
    {
        return $this->belongsTo(MovimientoInventario::class, 'idMovimiento');
    }
}
