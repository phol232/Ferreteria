<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = ['idProveedor', 'codigoProducto', 'nombreProducto', 'descripcionProducto' , 'cantidadProducto', 'costoProducto', 'gananciaProducto', 'precioProducto', 'imageProducto'];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'idProducto');
    }
}
