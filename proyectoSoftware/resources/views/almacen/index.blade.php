
@extends('layouts.plantilla')

@section('title','Productos')

@section('content')

<style>
        
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .tarjeta {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .tarjeta:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .titulo {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .titulo.text-danger {
            color: #d9534f; /* Rojo para bajo stock */
        }

        .cuerpo img {
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .cuerpo {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        .pie {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pie form input[type="number"] {
            width: 80px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .pie button {
            padding: 8px 15px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pie button:hover {
            background-color: #0056b3;
        }

        /* Diseño para alertas */
        .alert {
            width: 100%;
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>


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

    <h1>En esta pagina podras ver a todos los productos</h1>
    <div class="container">

        @foreach ($productos as $pro)
        <div class="tarjeta">

            <div class="titulo">{{$pro->nombreProducto}}</div>
            <div class="titulo">S/ {{$pro->precioProducto}}</div>
            @if($pro->cantidadProducto < 5)
                <div class="titulo text-danger font-weight-bold">
                    STOCK: {{ $pro->cantidadProducto }} (Bajo stock) Reabastecer Producto
                </div>
            @else
                <div class="titulo">
                    STOCK: {{ $pro->cantidadProducto }}
                </div>
            @endif
            <div class="cuerpo">
                <img src="{{$pro->imageProducto}}.jpg" alt="muestra" width="150px" height="150px">
                <div style="text-align: center; font-weight: bold;">
                    {{$pro->descripcionProducto}}
                </div>
            </div>
            
                

            <div class="pie">
                <form action="{{route('agregar_carro',$pro->id)}}" method="post">

                    {{csrf_field()}}

                    <label for="">Cantidad:</label>
                    <input type="number" name="cantidadProducto" min="1" max="{{ $pro->cantidadProducto }}" value="1" required>




                    <button type="submit">Add</button>
                </form>

            </div>

        </div>
        @endforeach
    </div>
@endsection
