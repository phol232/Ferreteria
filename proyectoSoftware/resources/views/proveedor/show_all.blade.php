@extends('layouts.plantilla')

@section('title','Proveedores')

@section('content')
    <div class="container" style="margin-top: 30px;">

        <h1 class="text-center" style="color: #007bff; font-weight: bold; margin-bottom: 30px;">Listado de Proveedores</h1>

        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="background-color: #f8f9fa; color: #333;">
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Razon Social</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">RUC</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Dirección</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Teléfono</th>
                    <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Correo</th>
                    <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $prov)
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$prov->razonSocial}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$prov->rucProveedor}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$prov->direccionProveedor}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$prov->telefonoProveedor}}</td>
                    <td style="padding: 10px; border: 1px solid #ddd;">{{$prov->correoProveedor}}</td>
                    <td style="text-align: center; padding: 10px; border: 1px solid #ddd;">
                        <a href="{{route('proveedor_get2',$prov->id)}}" style="color: #007bff; text-decoration: none; margin-right: 15px;">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center">
            <button style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; border: none; font-weight: bold; cursor: pointer;">
                <a href="{{ route('proveedor_index') }}" style="color: white; text-decoration: none;">Volver a Inicio</a>
            </button>
        </div>
    </div>
@endsection
