<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalleventas';

    protected $fillable = [
        'idVenta',
        'idProducto',
        'cantidadDetalleVenta',
        'subtotalDetalleVenta',
        'totalDetalleVenta'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'idVenta');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }
}
