<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'idCliente',
        'subtotalVenta',
        'gananciasVenta',
        'igvVenta',
        'totalVenta',
        'fechaVenta'
    ];

    protected $casts = [
        'fechaVenta' => 'date'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'idVenta');
    }
}
