<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    // API JSON endpoints for Angular
    public function apiIndex()
    {
        $ventas = Venta::with(['cliente', 'detalles.producto'])->orderBy('created_at', 'desc')->get();
        
        return response()->json($ventas);
    }

    public function apiShow($id)
    {
        $venta = Venta::with(['cliente', 'detalles.producto'])->findOrFail($id);
        return response()->json($venta);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'idCliente' => 'required|exists:clientes,id',
            'subtotalVenta' => 'required|numeric|min:0',
            'gananciasVenta' => 'required|numeric|min:0',
            'igvVenta' => 'required|numeric|min:0',
            'totalVenta' => 'required|numeric|min:0',
            'fechaVenta' => 'required|date',
            'detalles' => 'required|array|min:1',
            'detalles.*.idProducto' => 'required|exists:productos,id',
            'detalles.*.cantidadDetalleVenta' => 'required|integer|min:1',
            'detalles.*.subtotalDetalleVenta' => 'required|numeric|min:0',
            'detalles.*.totalDetalleVenta' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        
        try {
            // Create venta
            $venta = Venta::create([
                'idCliente' => $validated['idCliente'],
                'subtotalVenta' => $validated['subtotalVenta'],
                'gananciasVenta' => $validated['gananciasVenta'],
                'igvVenta' => $validated['igvVenta'],
                'totalVenta' => $validated['totalVenta'],
                'fechaVenta' => $validated['fechaVenta']
            ]);

            // Create detalles and update product stock
            foreach ($validated['detalles'] as $detalle) {
                DetalleVenta::create([
                    'idVenta' => $venta->id,
                    'idProducto' => $detalle['idProducto'],
                    'cantidadDetalleVenta' => $detalle['cantidadDetalleVenta'],
                    'subtotalDetalleVenta' => $detalle['subtotalDetalleVenta'],
                    'totalDetalleVenta' => $detalle['totalDetalleVenta']
                ]);

                // Update product stock
                $producto = Producto::findOrFail($detalle['idProducto']);
                $producto->cantidadProducto -= $detalle['cantidadDetalleVenta'];
                $producto->save();
            }

            DB::commit();

            // Load relationships for response
            $venta->load(['cliente', 'detalles.producto']);

            return response()->json([
                'message' => 'Venta creada exitosamente',
                'venta' => $venta
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear la venta',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function apiUpdate(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);

        $validated = $request->validate([
            'idCliente' => 'sometimes|required|exists:clientes,id',
            'subtotalVenta' => 'sometimes|required|numeric|min:0',
            'gananciasVenta' => 'sometimes|required|numeric|min:0',
            'igvVenta' => 'sometimes|required|numeric|min:0',
            'totalVenta' => 'sometimes|required|numeric|min:0',
            'fechaVenta' => 'sometimes|required|date'
        ]);

        $venta->update($validated);

        $venta->load(['cliente', 'detalles.producto']);

        return response()->json([
            'message' => 'Venta actualizada exitosamente',
            'venta' => $venta
        ]);
    }

    public function apiDestroy($id)
    {
        DB::beginTransaction();
        
        try {
            $venta = Venta::with('detalles')->findOrFail($id);

            // Restore product stock
            foreach ($venta->detalles as $detalle) {
                $producto = Producto::findOrFail($detalle->idProducto);
                $producto->cantidadProducto += $detalle->cantidadDetalleVenta;
                $producto->save();
            }

            // Delete detalles
            $venta->detalles()->delete();

            // Delete venta
            $venta->delete();

            DB::commit();

            return response()->json([
                'message' => 'Venta eliminada exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar la venta',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
