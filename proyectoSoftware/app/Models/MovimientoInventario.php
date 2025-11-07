<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    use HasFactory;

    protected $table = 'movimientos_inventario';

    protected $fillable = [
        'idProveedor',
        'tipoMovimiento',
        'descripcion',
        'fechaMovimiento'
    ];

    protected $casts = [
        'fechaMovimiento' => 'date'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleMovimiento::class, 'idMovimiento');
    }
}
