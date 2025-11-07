<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; // Asegúrate de tener el modelo Cliente
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    
    public function index(){

        return redirect()->route('show_cliente_all');

    }

    public function create(){

        return view('cliente.create');

    }

    public function store(Request $request){
        
        $cliente = new Cliente(Array(

            'nombreCliente' => $request->get('nombreCliente'),
            'apellidosCliente' => $request->get('apellidosCliente'),
            'dniCliente' => $request->get('dniCliente'),
            'direccionCliente' => $request->get('direccionCliente'),
            'telefonoCliente' => $request->get('telefonoCliente'),
            'correoCliente' => $request->get('correoCliente')
        ));
        
        $cliente->save();

        return redirect()->route('home')->with('message', 'Cliente creado exitosamente');

    }

    public function show_all(){

        $clientes = DB::table('clientes')->get();

        return view('cliente.index',['clientes' => $clientes]);

    }

    // --- API JSON endpoints for Angular ---
    public function apiIndex()
    {
        $clientes = DB::table('clientes')->get();
        return response()->json($clientes);
    }

    public function apiShow($id)
    {
        $cliente = Cliente::findOrFail($id);
        return response()->json($cliente);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nombreCliente' => 'required|string|max:50',
            'apellidosCliente' => 'nullable|string|max:60',
            'dniCliente' => 'nullable|string|max:15',
            'correoCliente' => 'required|email|max:50',
            'telefonoCliente' => 'required|string|max:15',
            'direccionCliente' => 'required|string|max:150'
        ]);

        // Set defaults for optional fields
        $validated['apellidosCliente'] = $validated['apellidosCliente'] ?? '';
        $validated['dniCliente'] = $validated['dniCliente'] ?? '00000000';

        $cliente = Cliente::create($validated);

        return response()->json([
            'message' => 'Cliente creado exitosamente',
            'cliente' => $cliente
        ], 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nombreCliente' => 'sometimes|required|string|max:50',
            'apellidosCliente' => 'sometimes|nullable|string|max:60',
            'dniCliente' => 'sometimes|nullable|string|max:15',
            'correoCliente' => 'sometimes|required|email|max:50',
            'telefonoCliente' => 'sometimes|required|string|max:15',
            'direccionCliente' => 'sometimes|required|string|max:150'
        ]);

        $cliente->update($validated);

        return response()->json([
            'message' => 'Cliente actualizado exitosamente',
            'cliente' => $cliente
        ]);
    }

    public function apiDestroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return response()->json([
            'message' => 'Cliente eliminado exitosamente'
        ]);
    }

}
