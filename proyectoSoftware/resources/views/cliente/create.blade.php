@extends('layouts.plantilla')

@section('title','Cliente')

@section('content')
    <div class="container" style="max-width: 600px; background-color: #f9f9f9; padding: 30px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
        <h1 class="text-center" style="color: #0056b3; font-weight: bold; margin-bottom: 20px;">Crear Cliente</h1>
        <form action="{{ route('cliente_store') }}" method="post" style="display: flex; flex-direction: column; gap: 20px;">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="nombreCliente" style="font-weight: bold; color: #333;">Nombre Cliente:</label>
                <input type="text" name="nombreCliente" maxlength="50" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="apellidosCliente" style="font-weight: bold; color: #333;">Apellidos Cliente:</label>
                <input type="text" name="apellidosCliente" maxlength="50" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="dniCliente" style="font-weight: bold; color: #333;">DNI Cliente:</label>
                <input type="text" name="dniCliente" pattern="[0-9]*" maxlength="8" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="direccionCliente" style="font-weight: bold; color: #333;">Dirección del Cliente:</label>
                <input type="text" name="direccionCliente" maxlength="150" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="telefonoCliente" style="font-weight: bold; color: #333;">Teléfono:</label>
                <input type="text" name="telefonoCliente" pattern="[0-9]*" maxlength="9" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group">
                <label for="correoCliente" style="font-weight: bold; color: #333;">Correo Electrónico:</label>
                <input type="email" name="correoCliente" maxlength="50" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group text-center">
                <button type="submit" style="background-color: #0056b3; color: #fff; padding: 12px 25px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%;">Crear Cliente</button>
            </div>
        </form>
    </div>
@endsection

