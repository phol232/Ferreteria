@extends('layouts.plantilla')

@section('title','Estudiante ' .$proveedor->rucProveedor)

@section('content')
    <div class="container" style="margin-top: 30px;">
        <h1 class="text-center" style="color: #007bff; font-weight: bold; margin-bottom: 30px;">Detalles del Proveedor</h1>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">

            <thead>
                <tr style="background-color: #f8f9fa; color: #333;">
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Razon Social</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">RUC</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Dirección</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Teléfono</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Correo</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$proveedor->razonSocial}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$proveedor->rucProveedor}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$proveedor->direccionProveedor}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$proveedor->telefonoProveedor}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$proveedor->correoProveedor}}</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center">
            <button style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; border: none; font-weight: bold; cursor: pointer;">
                <a href="{{ route('proveedor_index') }}" style="color: white; text-decoration: none;">Volver a Inicio</a>
            </button>
        </div>
    </div>
@endsection
