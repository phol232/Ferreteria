@extends('layouts.plantilla')

@section('title', 'Venta')

@section('content')
    <div class="container">
        <h1 class="page-title">En esta página podrás crear una venta</h1>
        <form action="{{ route('venta_store') }}" method="post" class="venta-form">

            {{ csrf_field() }}
            
            <div class="venta">
                <div class="client-info">
                    <label for="dniCliente">DNI Cliente:</label>
                    <input type="text" name="dniCliente" pattern="[0-9]*" maxlength="8" required>
                </div>

                <div class="product-info">
                    @foreach ($productos as $id => $detalles)
                        <div class="product-item">
                            <label>Nombre del Producto:</label>
                            <input type="text" value="{{ $detalles['nombre'] }}" disabled>

                            <label>Código del Producto:</label>
                            <input type="text" value="{{ $detalles['codigo'] }}" disabled>

                            <label>Descripción del Producto:</label>
                            <input type="text" value="{{ $detalles['precio'] }}" disabled>

                            <label>Cantidad del Producto:</label>
                            <input type="number" value="{{ $detalles['cantidad'] }}" disabled>

                            <label>Subtotal:</label>
                            <input type="number" value="{{ $detalles['precio'] * $detalles['cantidad'] }}" disabled>
                        </div>
                        @foreach($productos as $id => $detalles)
                            <input type="hidden" name="productos[{{ $id }}][id]" value="{{ $detalles['id'] }}">
                            <input type="hidden" name="productos[{{ $id }}][cantidad]" value="{{ $detalles['cantidad'] }}">
                            <input type="hidden" name="productos[{{ $id }}][nombre]" value="{{ $detalles['nombre'] }}">
                            <input type="hidden" name="productos[{{ $id }}][codigo]" value="{{ $detalles['codigo'] }}">
                            <input type="hidden" name="productos[{{ $id }}][precio]" value="{{ $detalles['precio'] }}">
                            <input type="hidden" name="productos[{{ $id }}][ganancia]" value="{{ $detalles['ganancia'] * $detalles['cantidad'] }}">
                        @endforeach
                    @endforeach
                </div>
            </div>
            
            <button type="submit" class="submit-btn">Crear Venta</button>
        </form>
    </div>

    <style>
        /* General Styling */
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Page Title */
        .page-title {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-weight: bold;
        }

        /* Form Styling */
        .venta-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .venta .client-info, .venta .product-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Labels & Inputs */
        label {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input:disabled {
            background-color: #f7f7f7;
        }

        .product-item {
            margin-bottom: 20px;
        }

        /* Submit Button */
        .submit-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background-color: #218838;
        }
    </style>
@endsection
