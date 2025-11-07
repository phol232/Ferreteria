@extends('layouts.plantilla')

@section('title','Proveedor')

@if(session('message'))
    <div class="alert alert-warning" style="margin-bottom: 20px; font-weight: bold; color: #856404; background-color: #fff3cd; border-color: #ffeeba; border-radius: 5px; padding: 10px 15px;">
        {{ session('message') }}
    </div>
@endif

@section('content')
    <div class="container" style="max-width: 800px; margin-top: 30px;">
        <h1 class="text-center" style="color: #007bff; font-weight: bold; margin-bottom: 20px;">Bienvenido a la página de proveedores</h1>
        <h2 class="text-center" style="color: #555;">Gestión de Proveedores</h2>

        <div style="display: flex; flex-direction: column; gap: 15px; align-items: center; margin-top: 30px;">
            <button style="background-color: #007bff; color: white; border: none; padding: 12px 30px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 80%; text-align: center;">
                <a href="{{ route('search_proveedor') }}" style="text-decoration: none; color: white;">Buscar Proveedor</a>
            </button>
            
            <button style="background-color: #28a745; color: white; border: none; padding: 12px 30px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 80%; text-align: center;">
                <a href="{{ route('show_proveedor_all') }}" style="text-decoration: none; color: white;">Listar Proveedores</a>
            </button>
            
            <button style="background-color: #007bff; color: white; border: none; padding: 12px 30px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 80%; text-align: center;">
                <a href="{{ route('proveedor_create') }}" style="text-decoration: none; color: white;">Crear Proveedor</a>
            </button>
            
            <button style="background-color: #ffc107; color: white; border: none; padding: 12px 30px; border-radius: 5px; font-weight: bold; cursor: pointer; width: 80%; text-align: center;">
                <a href="{{ route('search_edit') }}" style="text-decoration: none; color: white;">Editar Proveedor</a>
            </button>
        </div>
    </div>
@endsection
