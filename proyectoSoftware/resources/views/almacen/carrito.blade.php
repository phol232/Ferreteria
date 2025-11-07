@extends('layouts.plantilla')

@section('title','Carrito de Compras')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <h1 class="text-center" style="color: #007bff; font-weight: bold;">Carrito de Compras</h1>

        @if(session('carrito') && count(session('carrito')) > 0)
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background-color: #f8f9fa; color: #333;">
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Producto</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Cantidad</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Precio</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Subtotal</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('carrito') as $id => $detalles)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $detalles['nombre'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $detalles['cantidad'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $detalles['precio'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $detalles['cantidad'] * $detalles['precio'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <form action="{{ route('quitar_carro', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 5px;">Quitar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 20px;">
                <h4>IGV: 
                    {{ array_sum(array_map(function($detalles) {
                        return ($detalles['cantidad'] * $detalles['precio'])*0.18;
                    }, session('carrito'))) }}
                </h4>
                <h4>Total: 
                    {{ array_sum(array_map(function($detalles) {
                        return ($detalles['cantidad'] * $detalles['precio'])+($detalles['cantidad'] * $detalles['precio'])*0.18;
                    }, session('carrito'))) }}
                </h4>
            </div>

            <form action="{{route('venta_create')}}" method="get" style="margin-top: 20px;">
                @csrf
                @foreach(session('carrito') as $id => $detalles)
                    <input type="hidden" name="productos[{{ $id }}][id]" value="{{ $id }}">
                    <input type="hidden" name="productos[{{ $id }}][cantidad]" value="{{ $detalles['cantidad'] }}">
                    <input type="hidden" name="productos[{{ $id }}][nombre]" value="{{ $detalles['nombre'] }}">
                    <input type="hidden" name="productos[{{ $id }}][codigo]" value="{{ $detalles['codigo'] }}">
                    <input type="hidden" name="productos[{{ $id }}][precio]" value="{{ $detalles['precio'] }}">
                    <input type="hidden" name="productos[{{ $id }}][ganancia]" value="{{ $detalles['ganancia']*$detalles['cantidad'] }}">
                @endforeach
                <button type="submit" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; border: none; font-weight: bold; cursor: pointer;">Realizar Venta</button>
            </form>

        @else
            <p class="text-center" style="font-size: 18px; color: #888;">Tu carrito está vacío.</p>
        @endif
    </div>
@endsection
