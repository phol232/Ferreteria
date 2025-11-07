
@extends('layouts.plantilla')

@section('title','SOCIO CONSTRUCTOR - Sistema de Ventas y Almacén')


@section('content')

    @if(session('message'))
        <div class="alert alert-warning">
            {{ session('message') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <h1 class="page-title">Bienvenido a la Página de Inicio</h1>
        <div class="image-container">
            <img src="{{ asset('images/footer.jpg') }}" alt="Imagen de bienvenida" class="welcome-image">
        </div>
    </div>

    <style>
        /* General Layout */
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        /* Title Styling */
        .page-title {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Image Styling */
        .image-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .welcome-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .welcome-image:hover {
            transform: scale(1.05);
        }

        /* Alert Styling */
        .alert-warning {
            background-color: #f9c74f;
            color: #333;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
@endsection
