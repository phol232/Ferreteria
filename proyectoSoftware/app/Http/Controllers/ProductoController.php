<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    // API JSON endpoints for Angular
    public function apiIndex()
    {
        $productos = Producto::with('proveedor')->get();
        
        // Transform data to match frontend expectations
        $productos = $productos->map(function($producto) {
            return [
                'id' => $producto->id,
                'idProveedor' => $producto->idProveedor,
                'codigoProducto' => $producto->codigoProducto,
                'nombreProducto' => $producto->nombreProducto,
                'descripcionProducto' => $producto->descripcionProducto,
                'cantidadProducto' => $producto->cantidadProducto,
                'costoProducto' => $producto->costoProducto,
                'gananciaProducto' => $producto->gananciaProducto,
                'precioProducto' => $producto->precioProducto,
                'imageProducto' => $producto->imageProducto,
                'created_at' => $producto->created_at,
                'updated_at' => $producto->updated_at,
                'proveedor' => $producto->proveedor
            ];
        });

        return response()->json($productos);
    }

    public function apiShow($id)
    {
        $producto = Producto::with('proveedor')->findOrFail($id);
        return response()->json($producto);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'idProveedor' => 'required|exists:proveedores,id',
            'codigoProducto' => 'required|string|max:12',
            'nombreProducto' => 'required|string|max:50',
            'descripcionProducto' => 'required|string|max:250',
            'cantidadProducto' => 'required|integer|min:0',
            'costoProducto' => 'required|numeric|min:0',
            'gananciaProducto' => 'required|numeric|min:0',
            'precioProducto' => 'required|numeric|min:0',
            'imageProducto' => 'nullable|string|max:10000'
        ]);

        // Set default image if not provided
        $validated['imageProducto'] = $validated['imageProducto'] ?? '';

        $producto = Producto::create($validated);

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'producto' => $producto
        ], 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'idProveedor' => 'sometimes|required|exists:proveedores,id',
            'codigoProducto' => 'sometimes|required|string|max:12',
            'nombreProducto' => 'sometimes|required|string|max:50',
            'descripcionProducto' => 'sometimes|required|string|max:250',
            'cantidadProducto' => 'sometimes|required|integer|min:0',
            'costoProducto' => 'sometimes|required|numeric|min:0',
            'gananciaProducto' => 'sometimes|required|numeric|min:0',
            'precioProducto' => 'sometimes|required|numeric|min:0',
            'imageProducto' => 'sometimes|nullable|string|max:10000'
        ]);

        $producto->update($validated);

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'producto' => $producto
        ]);
    }

    public function apiDestroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado exitosamente'
        ]);
    }

    // Batch create/update products
    public function apiBatchStore(Request $request)
    {
        $validated = $request->validate([
            'idProveedor' => 'required|exists:proveedores,id',
            'productos' => 'required|array|min:1',
            'productos.*.codigoProducto' => 'required|string|max:12',
            'productos.*.nombreProducto' => 'required|string|max:50',
            'productos.*.descripcionProducto' => 'required|string|max:250',
            'productos.*.cantidadProducto' => 'required|integer|min:0',
            'productos.*.costoProducto' => 'required|numeric|min:0',
            'productos.*.gananciaProducto' => 'required|numeric|min:0',
            'productos.*.precioProducto' => 'required|numeric|min:0',
            'productos.*.imageProducto' => 'nullable|string|max:10000'
        ]);

        DB::beginTransaction();
        
        try {
            $created = 0;
            $updated = 0;

            foreach ($validated['productos'] as $productoData) {
                // Check if product exists by code
                $producto = Producto::where('codigoProducto', $productoData['codigoProducto'])->first();

                $productoData['idProveedor'] = $validated['idProveedor'];
                $productoData['imageProducto'] = $productoData['imageProducto'] ?? '';

                if ($producto) {
                    // Update existing product - add to stock
                    $producto->cantidadProducto += $productoData['cantidadProducto'];
                    $producto->costoProducto = $productoData['costoProducto'];
                    $producto->gananciaProducto = $productoData['gananciaProducto'];
                    $producto->precioProducto = $productoData['precioProducto'];
                    $producto->nombreProducto = $productoData['nombreProducto'];
                    $producto->descripcionProducto = $productoData['descripcionProducto'];
                    $producto->imageProducto = $productoData['imageProducto'];
                    $producto->save();
                    $updated++;
                } else {
                    // Create new product
                    Producto::create($productoData);
                    $created++;
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Productos procesados exitosamente',
                'created' => $created,
                'updated' => $updated
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al procesar productos',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

