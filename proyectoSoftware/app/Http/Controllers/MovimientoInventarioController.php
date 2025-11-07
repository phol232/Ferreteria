<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoInventario;
use App\Models\DetalleMovimiento;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class MovimientoInventarioController extends Controller
{
    public function apiIndex()
    {
        $movimientos = MovimientoInventario::with(['proveedor', 'detalles'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json($movimientos);
    }

    public function apiShow($id)
    {
        $movimiento = MovimientoInventario::with(['proveedor', 'detalles'])->findOrFail($id);
        return response()->json($movimiento);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'idProveedor' => 'required|exists:proveedores,id',
            'tipoMovimiento' => 'required|string|in:entrada,salida,ajuste',
            'descripcion' => 'nullable|string',
            'fechaMovimiento' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.codigoProducto' => 'required|string|max:12',
            'productos.*.nombreProducto' => 'required|string|max:50',
            'productos.*.descripcionProducto' => 'required|string|max:250',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.costoProducto' => 'required|numeric|min:0',
            'productos.*.gananciaProducto' => 'required|numeric|min:0',
            'productos.*.precioProducto' => 'required|numeric|min:0',
            'productos.*.imageProducto' => 'nullable|string'
        ]);

        DB::beginTransaction();
        
        try {
            // Create movimiento
            $movimiento = MovimientoInventario::create([
                'idProveedor' => $validated['idProveedor'],
                'tipoMovimiento' => $validated['tipoMovimiento'],
                'descripcion' => $validated['descripcion'] ?? '',
                'fechaMovimiento' => $validated['fechaMovimiento']
            ]);

            $created = 0;
            $updated = 0;

            // Process each product
            foreach ($validated['productos'] as $productoData) {
                // Save detail
                DetalleMovimiento::create([
                    'idMovimiento' => $movimiento->id,
                    'codigoProducto' => $productoData['codigoProducto'],
                    'nombreProducto' => $productoData['nombreProducto'],
                    'descripcionProducto' => $productoData['descripcionProducto'],
                    'cantidad' => $productoData['cantidad'],
                    'costoProducto' => $productoData['costoProducto'],
                    'gananciaProducto' => $productoData['gananciaProducto'],
                    'precioProducto' => $productoData['precioProducto'],
                    'imageProducto' => $productoData['imageProducto'] ?? ''
                ]);

                // Check if product exists
                $producto = Producto::where('codigoProducto', $productoData['codigoProducto'])->first();

                if ($producto) {
                    // Update existing product
                    $producto->cantidadProducto += $productoData['cantidad'];
                    $producto->costoProducto = $productoData['costoProducto'];
                    $producto->gananciaProducto = $productoData['gananciaProducto'];
                    $producto->precioProducto = $productoData['precioProducto'];
                    $producto->nombreProducto = $productoData['nombreProducto'];
                    $producto->descripcionProducto = $productoData['descripcionProducto'];
                    if (!empty($productoData['imageProducto'])) {
                        $producto->imageProducto = $productoData['imageProducto'];
                    }
                    $producto->save();
                    $updated++;
                } else {
                    // Create new product
                    Producto::create([
                        'idProveedor' => $validated['idProveedor'],
                        'codigoProducto' => $productoData['codigoProducto'],
                        'nombreProducto' => $productoData['nombreProducto'],
                        'descripcionProducto' => $productoData['descripcionProducto'],
                        'cantidadProducto' => $productoData['cantidad'],
                        'costoProducto' => $productoData['costoProducto'],
                        'gananciaProducto' => $productoData['gananciaProducto'],
                        'precioProducto' => $productoData['precioProducto'],
                        'imageProducto' => $productoData['imageProducto'] ?? ''
                    ]);
                    $created++;
                }
            }

            DB::commit();

            $movimiento->load(['proveedor', 'detalles']);

            return response()->json([
                'message' => 'Movimiento creado exitosamente',
                'movimiento' => $movimiento,
                'productos_creados' => $created,
                'productos_actualizados' => $updated
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function apiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'idProveedor' => 'required|exists:proveedores,id',
            'tipoMovimiento' => 'required|string|in:entrada,salida,ajuste',
            'descripcion' => 'nullable|string',
            'fechaMovimiento' => 'required|date',
            'productos' => 'required|array|min:1',
            'productos.*.codigoProducto' => 'required|string|max:12',
            'productos.*.nombreProducto' => 'required|string|max:50',
            'productos.*.descripcionProducto' => 'required|string|max:250',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.costoProducto' => 'required|numeric|min:0',
            'productos.*.gananciaProducto' => 'required|numeric|min:0',
            'productos.*.precioProducto' => 'required|numeric|min:0',
            'productos.*.imageProducto' => 'nullable|string'
        ]);

        DB::beginTransaction();
        
        try {
            $movimiento = MovimientoInventario::with('detalles')->findOrFail($id);

            // Revert old stock changes
            foreach ($movimiento->detalles as $detalle) {
                $producto = Producto::where('codigoProducto', $detalle->codigoProducto)->first();
                if ($producto) {
                    $producto->cantidadProducto -= $detalle->cantidad;
                    $producto->save();
                }
            }

            // Delete old detalles
            $movimiento->detalles()->delete();

            // Update movimiento
            $movimiento->update([
                'idProveedor' => $validated['idProveedor'],
                'tipoMovimiento' => $validated['tipoMovimiento'],
                'descripcion' => $validated['descripcion'] ?? '',
                'fechaMovimiento' => $validated['fechaMovimiento']
            ]);

            // Add new products
            foreach ($validated['productos'] as $productoData) {
                DetalleMovimiento::create([
                    'idMovimiento' => $movimiento->id,
                    'codigoProducto' => $productoData['codigoProducto'],
                    'nombreProducto' => $productoData['nombreProducto'],
                    'descripcionProducto' => $productoData['descripcionProducto'],
                    'cantidad' => $productoData['cantidad'],
                    'costoProducto' => $productoData['costoProducto'],
                    'gananciaProducto' => $productoData['gananciaProducto'],
                    'precioProducto' => $productoData['precioProducto'],
                    'imageProducto' => $productoData['imageProducto'] ?? ''
                ]);

                $producto = Producto::where('codigoProducto', $productoData['codigoProducto'])->first();

                if ($producto) {
                    $producto->cantidadProducto += $productoData['cantidad'];
                    $producto->costoProducto = $productoData['costoProducto'];
                    $producto->gananciaProducto = $productoData['gananciaProducto'];
                    $producto->precioProducto = $productoData['precioProducto'];
                    $producto->nombreProducto = $productoData['nombreProducto'];
                    $producto->descripcionProducto = $productoData['descripcionProducto'];
                    if (!empty($productoData['imageProducto'])) {
                        $producto->imageProducto = $productoData['imageProducto'];
                    }
                    $producto->save();
                } else {
                    Producto::create([
                        'idProveedor' => $validated['idProveedor'],
                        'codigoProducto' => $productoData['codigoProducto'],
                        'nombreProducto' => $productoData['nombreProducto'],
                        'descripcionProducto' => $productoData['descripcionProducto'],
                        'cantidadProducto' => $productoData['cantidad'],
                        'costoProducto' => $productoData['costoProducto'],
                        'gananciaProducto' => $productoData['gananciaProducto'],
                        'precioProducto' => $productoData['precioProducto'],
                        'imageProducto' => $productoData['imageProducto'] ?? ''
                    ]);
                }
            }

            DB::commit();

            $movimiento->load(['proveedor', 'detalles']);

            return response()->json([
                'message' => 'Movimiento actualizado exitosamente',
                'movimiento' => $movimiento
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al actualizar el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function apiDestroy($id)
    {
        DB::beginTransaction();
        
        try {
            $movimiento = MovimientoInventario::with('detalles')->findOrFail($id);

            // Delete detalles
            $movimiento->detalles()->delete();

            // Delete movimiento
            $movimiento->delete();

            DB::commit();

            return response()->json([
                'message' => 'Movimiento eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al eliminar el movimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
