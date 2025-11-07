@extends('layouts.plantilla')

@section('title','Proveedor')

@section('content')

    @php
        $proveedor = session('proveedor'); // Acceder al proveedor desde la sesión
    @endphp

    <div class="container" style="max-width: 600px; background-color: #f9f9f9; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center" style="color: #007bff; font-weight: bold; margin-bottom: 30px;">Editar Proveedor</h1>
        
        <form action="{{ route('proveedor_update', $proveedor->id) }}" method="post" style="display: flex; flex-direction: column; gap: 20px;">
            {{ csrf_field() }}
            @method('PUT')
            
            <div class="form-group">
                <label for="razonSocial" style="font-weight: bold; color: #333;">Razón Social:</label>
                <input type="text" id="razon_social" name="razonSocial" maxlength="50" value="{{ $proveedor->razonSocial }}" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="rucProveedor" style="font-weight: bold; color: #333;">RUC:</label>
                <input type="text" id="rucProveedor" name="rucProveedor" maxlength="11" value="{{ $proveedor->rucProveedor }}" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="direccionProveedor" style="font-weight: bold; color: #333;">Dirección del Proveedor:</label>
                <input type="text" id="direccionProveedor" name="direccionProveedor" maxlength="150" value="{{ $proveedor->direccionProveedor }}" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="telefonoProveedor" style="font-weight: bold; color: #333;">Teléfono:</label>
                <input type="text" id="telefonoProveedor" name="telefonoProveedor" pattern="[0-9]*" maxlength="9" value="{{ $proveedor->telefonoProveedor }}" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="correoProveedor" style="font-weight: bold; color: #333;">Correo Electrónico:</label>
                <input type="email" id="correoProveedor" name="correoProveedor" maxlength="50" value="{{ $proveedor->correoProveedor }}" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group text-center">
                <button type="submit" style="background-color: #007bff; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%;">Editar Proveedor</button>
            </div>
        </form>
    </div>

@endsection
