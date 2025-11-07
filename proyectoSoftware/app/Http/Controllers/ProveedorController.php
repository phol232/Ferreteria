<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function index(){
        return view('proveedor.index');
    }

    public function create(){
        return view('proveedor.create');
    }

    public function show(request $request){
        $proveedor = DB::table('proveedores')
            ->select('proveedores.*')
            ->where('proveedores.rucProveedor',$request->get('rucProveedor'))
            ->first();

        if($proveedor != null){
            return view('proveedor.show',['proveedor' => $proveedor]);
        }else{
            return redirect()->route('proveedor_index')->with('message', 'Proveedor no existente');
        }
    }

    public function show_all(){

        $proveedores = DB::table('proveedores')->get();

        return view('proveedor.show_all',['proveedores' => $proveedores]);
    }

    public function search(){
        return view('proveedor.search');
    }

    public function store(request $request){
        $proveedor = new Proveedor(array(
            'razonSocial' => $request->get('razonSocial'),
            'rucProveedor' => $request->get('rucProveedor'),
            'direccionProveedor' => $request->get('direccionProveedor'),
            'telefonoProveedor' => $request->get('telefonoProveedor'),
            'correoProveedor' => $request->get('correoProveedor')
        ));

        $proveedor->save();

        return redirect()->route('proveedor_index')->with('message', 'Proveedor creado exitosamente');
    }

    public function search_edit(){
        return view('proveedor.search_edit');
    }

    public function edit_get(request $request){
        $proveedor = DB::table('proveedores')
        ->select('proveedores.*')
        ->where('proveedores.rucProveedor',$request->get('rucProveedor'))
        ->first();

        if($proveedor != null){
            return redirect()->route('proveedor_edit',$proveedor->id)->with('proveedor', $proveedor);
        }else{
            return redirect()->route('proveedor_index')->with('message', 'Proveedor no existente');
        }
    }

    public function edit_get2($id){
        $proveedor = Proveedor::findOrFail($id);

        return redirect()->route('proveedor_edit',$proveedor->id)->with('proveedor', $proveedor);
    }


    public function edit(request $request,$id){
        
        return view('proveedor.edit',['proveedor' => $request]);
    }

    public function update(request $request,$id){

        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update([
            'razonSocial' => $request->get('razonSocial'),
            'rucProveedor' => $request->get('rucProveedor'),
            'direccionProveedor' => $request->get('direccionProveedor'),
            'telefonoProveedor' => $request->get('telefonoProveedor'),
            'correoProveedor' => $request->get('correoProveedor')
        ]);
        
        return redirect()->route('proveedor_index')->with('message', 'Proveedor actualizado exitosamente.');
    }

    public function delete_get($id){
        $proveedor = Proveedor::findOrFail($id);

        return redirect()->route('proveedor_destroy',$proveedor->id)->with('proveedor', $proveedor);
    }

    public function destroy(request $request){
        return view('proveedor.delete',['proveedor' => $request]);
    }

    public function delete($id){
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->delete();

        return redirect()->route('proveedor_index')->with('message', 'Proveedor eliminado exitosamente');
    }
    
    // --- API JSON endpoints for Angular ---
    public function apiIndex()
    {
        $proveedores = DB::table('proveedores')
            ->select('*', DB::raw('razonSocial as nombreProveedor'))
            ->get();
        return response()->json($proveedores);
    }

    public function apiShow($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombreProveedor = $proveedor->razonSocial;
        return response()->json($proveedor);
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'nombreProveedor' => 'required|string|max:255',
            'rucProveedor' => 'required|string|size:11|regex:/^[0-9]+$/',
            'correoProveedor' => 'required|email|max:255',
            'telefonoProveedor' => 'required|string|max:20',
            'direccionProveedor' => 'required|string|max:500'
        ]);

        // Map nombreProveedor to razonSocial (the actual DB column)
        $validated['razonSocial'] = $validated['nombreProveedor'];
        unset($validated['nombreProveedor']);

        $proveedor = Proveedor::create($validated);

        return response()->json([
            'message' => 'Proveedor creado exitosamente',
            'proveedor' => $proveedor
        ], 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $validated = $request->validate([
            'nombreProveedor' => 'sometimes|required|string|max:255',
            'rucProveedor' => 'sometimes|required|string|size:11|regex:/^[0-9]+$/',
            'correoProveedor' => 'sometimes|required|email|max:255',
            'telefonoProveedor' => 'sometimes|required|string|max:20',
            'direccionProveedor' => 'sometimes|required|string|max:500'
        ]);

        // Map nombreProveedor to razonSocial if present
        if (isset($validated['nombreProveedor'])) {
            $validated['razonSocial'] = $validated['nombreProveedor'];
            unset($validated['nombreProveedor']);
        }

        $proveedor->update($validated);

        return response()->json([
            'message' => 'Proveedor actualizado exitosamente',
            'proveedor' => $proveedor
        ]);
    }

    public function apiDestroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return response()->json([
            'message' => 'Proveedor eliminado exitosamente'
        ]);
    }
}
