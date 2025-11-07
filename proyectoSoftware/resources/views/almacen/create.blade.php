@extends('layouts.plantilla')

@section('title','Agregar Producto')

@section('content')
<div class="container" style="max-width: 600px; margin-top: 30px;">
    <h1 class="text-center" style="color: #007bff; font-weight: bold;">Agregar Nuevo Producto</h1>
    
    <form action="{{route('producto_store')}}" method="POST" style="margin-top: 20px;">
        {{csrf_field()}}

        <div style="margin-bottom: 15px;">
            <label for="nombre" style="font-weight: bold;">Nombre del Producto:</label>
            <input type="text" id="nombreProducto" name="nombreProducto" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="codigo" style="font-weight: bold;">Codigo del Producto:</label>
            <input type="text" id="codigoProducto" name="codigoProducto" pattern="[0-9]*" maxlength="12" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="descripcion" style="font-weight: bold;">Descripcion del Producto:</label>
            <input type="text" id="descripcionProducto" name="descripcionProducto" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="stock" style="font-weight: bold;">Stock del Producto:</label>
            <input type="number" id="cantidadProducto" name="cantidadProducto" min="1" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="costo" style="font-weight: bold;">Costo:</label>
            <input type="number" step="0.01" id="costoProducto" name="costoProducto" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="ganancia" style="font-weight: bold;">Ganancia:</label>
            <input type="number" step="0.01" id="gananciaProducto" name="gananciaProducto" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="image" style="font-weight: bold;">Imagen del Producto:</label>
            <input type="text" id="imageProducto" name="imageProducto" class="form-control" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="proveedor" style="font-weight: bold;">Seleccionar Proveedor:</label>
            <input list="proveedores" id="proveedor" name="idProveedor" placeholder="Seleccione un proveedor" class="form-control" required>
            <datalist id="proveedores">
                @foreach($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->razonSocial }}</option>
                @endforeach
            </datalist>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </div>
    </form>
</div>
@endsection
