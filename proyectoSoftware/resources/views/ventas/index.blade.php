@extends('layouts.plantilla')

@section('title', 'Ventas')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Listado de Ventas</h1>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Fecha Venta</th>
                    <th>Subtotal Venta</th>
                    <th>Ganancias Venta</th>
                    <th>IGV Venta</th>
                    <th>Total Venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->fechaVenta }}</td>
                        <td>{{ $venta->subtotalVenta }}</td>
                        <td>{{ $venta->gananciasVenta }}</td>
                        <td>{{ $venta->igvVenta }}</td>
                        <td>{{ $venta->totalVenta }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
