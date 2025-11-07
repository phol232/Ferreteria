@extends('layouts.plantilla')

@section('title','Clientes')

@section('content')
    <div class="container" style="padding: 30px; max-width: 1000px; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center" style="color: #0056b3; font-weight: bold; margin-bottom: 30px;">Lista de Clientes</h1>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <thead>
                <tr style="background-color: #0056b3; color: #fff;">
                    <th style="padding: 12px; text-align: left;">Nombre Cliente</th>
                    <th style="padding: 12px; text-align: left;">Apellidos Cliente</th>
                    <th style="padding: 12px; text-align: left;">DNI Cliente</th>
                    <th style="padding: 12px; text-align: left;">Dirección Cliente</th>
                    <th style="padding: 12px; text-align: left;">Teléfono Cliente</th>
                    <th style="padding: 12px; text-align: left;">Correo Cliente</th>
                    <th style="padding: 12px; text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 12px;">{{$cliente->nombreCliente}}</td>
                        <td style="padding: 12px;">{{$cliente->apellidosCliente}}</td>
                        <td style="padding: 12px;">{{$cliente->dniCliente}}</td>
                        <td style="padding: 12px;">{{$cliente->direccionCliente}}</td>
                        <td style="padding: 12px;">{{$cliente->telefonoCliente}}</td>
                        <td style="padding: 12px;">{{$cliente->correoCliente}}</td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="{{route('proveedor_get2',$cliente->id)}}" style="color: #0056b3; font-weight: bold; text-decoration: none;">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
