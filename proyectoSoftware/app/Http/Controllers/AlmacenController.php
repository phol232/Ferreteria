<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto; // Asegúrate de tener el modelo Producto
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    public function index()
    {
        // Obtener todos los productos y pasar a la vista
        $productos = DB::table('productos')->get();
       
        return view('almacen.index',['productos' => $productos]);
    }

    public function agregarAlCarrito(Request $request, $id){

    $producto = Producto::find($id);

    // Verificar si el producto existe
    if (!$producto) {
        return redirect()->back()->with('error', 'Producto no encontrado.');
    }
    
    // Verificar si la cantidad solicitada no excede el stock
    $cantidadSolicitada = $request->get('cantidadProducto');
    if ($cantidadSolicitada > $producto->cantidadProducto) {
        return redirect()->back()->with('error', 'La cantidad solicitada excede el stock disponible.');
    }

    // Verificar si el carrito ya existe en la sesión
    $carrito = session()->get('carrito', []);

    // Si el producto ya está en el carrito, incrementar la cantidad
    if (isset($carrito[$id])) {
        // Verificar si la cantidad total después del incremento excede el stock
        if ($carrito[$id]['cantidad'] + $cantidadSolicitada > $producto->cantidadProducto) {
            return redirect()->back()->with('error', 'La cantidad total en el carrito excede el stock disponible.');
        }
        $carrito[$id]['cantidad'] += $cantidadSolicitada;
    } else {
        // Si no está en el carrito, agregarlo con la cantidad solicitada
        $carrito[$id] = [
            "nombre" => $producto->nombreProducto,
            "codigo" => $producto->codigoProducto,
            "cantidad" => $cantidadSolicitada,
            "ganancia" => $producto->gananciaProducto,
            "precio" => $producto->precioProducto,
            "image" => $producto->imageProducto
        ];
    }

    // Guardar el carrito en la sesión
    session()->put('carrito', $carrito);

    return redirect()->back()->with('success', 'Producto agregado al carrito!');
}

    public function mostrarCarrito(){

        $carrito = session()->get('carrito', []);
        return view('almacen.carrito', compact('carrito'));
        //return redirect('mostrar_carro')->with('carrito', $carrito);
    }

    public function quitarDelCarrito($id){

        $carrito = session()->get('carrito');

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function realizarVenta(Request $request){

    $productos = $request->input('productos');

    return redirect()->route('producto_index')->with('success', 'Venta realizada con éxito.');
    
    }

    public function create(Request $request){

        $proveedores = DB::table('proveedores')->get();

        // Mostrar el formulario para agregar un nuevo producto
        return view('almacen.create',['proveedores' => $proveedores]);
    }

    public function store(Request $request){

        // Validar y guardar el nuevo producto
        $costo = $request->get('costoProducto');
        $ganancia = $request->get('gananciaProducto');
        $total = $costo + $ganancia;

        $producto = new Producto(Array(

            'idProveedor' => $request->get('idProveedor'),
            'codigoProducto' => $request->get('codigoProducto'),
            'nombreProducto' => $request->get('nombreProducto'),
            'descripcionProducto' => $request->get('descripcionProducto'),
            'cantidadProducto' => $request->get('cantidadProducto'),
            'costoProducto' => $costo,
            'gananciaProducto' => $ganancia,
            'precioProducto' => $total,
            'imageProducto' => $request->get('imageProducto')
        ));
        
        $producto->save();

        return redirect()->route('producto_index')->with('message', 'Producto creado exitosamente');
    }

    public function show_all(){

        //Mostrar todos los productos
        $productos = DB::table('productos')->get();

        return view('almacen.show_all',['productos' => $productos]);

    }

    public function show($id)
    {
        // Mostrar los detalles de un producto específico
        
        $producto = Producto::findOrFail($id);

        $proveedor = DB::table('proveedores')
        ->select('proveedores.*')
        ->where('proveedores.id',$producto->idProveedor)
        ->first();

        return redirect()->route('producto_show',$producto->id)
            ->with('producto', $producto)
            ->with('proveedor', $proveedor);

    }

    public function show_name(Request $request,$id)
    {
        // Mostrar los detalles de un producto específico
        
        $producto = DB::table('productos')
        ->select('productos.id')
        ->where('productos.nombreProducto',$request->get('nombreProducto'))
        ->first();

        if($producto != null){
            return redirect()->route('producto_show',$producto->id);
        }else{
            return redirect()->route('producto_index')->with('message', 'Proveedor no existente');
        }

    }

    public function edit_get($id)
    {
        $producto = Producto::findOrFail($id);

        return redirect()->route('producto_edit',$producto->id)->with('producto', $producto);
    }

    public function edit(request $request,$id){
        
        return view('almacen.edit',['producto' => $request]);
    }

    public function update(Request $request, $id){
        $producto = Producto::findOrFail($id);

        $costo = $request->get('costoProducto');
        $ganancia = $request->get('gananciaProducto');
        $total = $costo + $ganancia;

        $producto->update([
            'imageProducto' => $request->get('imageProducto'),
            'codigoProducto' => $request->get('codigoProducto'),
            'nombreProducto' => $request->get('nombreProducto'),
            'descripcionProducto' => $request->get('descripcionProducto'),
            'cantidadProducto' => $request->get('cantidadProducto'),
            'costoProducto' => $costo ,
            'gananciaProducto' => $ganancia,
            'precioProducto' => $total
        ]);
        
        return redirect()->route('home')->with('message', 'Producto actualizado exitosamente.');
    }

    public function destroy(){
        // Eliminar un producto
       
        return view('almacen.create');
    }

    public function delete($id)
    {
        // Eliminar un producto
       
        return redirect()->route('almacen.index')->with('success', 'Producto eliminado exitosamente.');
    }

    // --- API JSON endpoints for Angular ---
    public function apiIndex()
    {
        $productos = DB::table('productos')->get();
        return response()->json($productos);
    }

    public function apiShow($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nombreProducto' => 'required|string|max:50',
            'codigoProducto' => 'required|string|max:12',
            'idProveedor' => 'required|integer|exists:proveedores,id',
            'cantidadProducto' => 'required|integer|min:0',
            'costoProducto' => 'required|numeric|min:0',
            'descripcionProducto' => 'nullable|string|max:250',
            'imageProducto' => 'nullable|string'
        ]);

        $producto = new Producto([
            'nombreProducto' => $validated['nombreProducto'],
            'codigoProducto' => $validated['codigoProducto'],
            'cantidadProducto' => $validated['cantidadProducto'],
            'costoProducto' => $validated['costoProducto'],
            'descripcionProducto' => $validated['descripcionProducto'] ?? '',
            'gananciaProducto' => 0,
            'precioProducto' => $validated['costoProducto'],
            'imageProducto' => $request->input('imageProducto', 'default.png'),
            'idProveedor' => $request->input('idProveedor')
        ]);

        $producto->save();

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'producto' => $producto
        ], 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombreProducto' => 'sometimes|required|string|max:255',
            'codigoProducto' => 'sometimes|required|string|max:100',
            'cantidadProducto' => 'sometimes|required|integer|min:0',
            'costoProducto' => 'sometimes|required|numeric|min:0',
            'descripcionProducto' => 'nullable|string'
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
}
