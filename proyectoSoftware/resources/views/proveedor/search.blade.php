
@extends('layouts.plantilla')

@section('title','Proveedor')

@section('content')
    <div class="container" style="max-width: 800px; margin-top: 30px;">
        <h1 class="text-center" style="color: #007bff; font-weight: bold; margin-bottom: 30px;">Buscar Proveedor</h1>

        <form action="{{route('proveedor_show')}}" method="GET" style="display: flex; flex-direction: column; gap: 20px;">

            {{ csrf_field() }}

            <label for="rucProveedor" style="font-weight: bold; color: #555;">RUC del Proveedor:</label>
            <input type="text" id="rucProveedor" name="rucProveedor" maxlength="11" placeholder="Ingrese el RUC del proveedor" style="padding: 10px; border-radius: 5px; border: 1px solid #ccc; font-size: 16px; width: 100%;" required>

            <button type="submit" style="background-color: #007bff; color: white; border: none; padding: 12px 30px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 100%; text-align: center;">Buscar Proveedor</button>
        </form>
    </div>
@endsection
