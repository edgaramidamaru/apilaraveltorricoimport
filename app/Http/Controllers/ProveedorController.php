<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedor=Proveedor::select("proveedor.*")->get()->toArray();
        return response()->json($proveedor);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombreempresa'=>'required',
            'razonsocial'=>'required',
            'nombreproveedor'=>'required',
            'numcontacto'=>'nullable|numeric',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        } try {
            Proveedor::create($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Se registro con exito al Proveedor",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }

    public function show(string $id)
    {
        $proveedor=Proveedor::select("proveedor.*")->where("proveedor.id",$id)->first();
        return response()->json([
            "ok"=>true,
            "data"=>$proveedor,
        ]);
    }
    public function showto()
    {
        $proveedor=Proveedor::all();
        return response()->json([
            "ok"=>true,
            "data"=>$proveedor,
        ]);
    }
    public function edit(string $id)
    {
        
    }
    public function update(Request $request, string $id)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombreempresa'=>'nullable',
            'razonsocial'=>'nullable',
            'nombreproveedor'=>'nullable',
            'numcontacto'=>'nullable|numeric',

        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        } try {
            $proveedor=Proveedor::find($id);
            if($proveedor==false){
            return response()->json([
                "ok" => false,
                "mensaje" => "No se encontro",
            ]);
        }
        $proveedor->update($input);
        return response()->json([
            "ok"=>true,
            "mensaje"=>"Se modifico con exito al Proveedor"
        ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
     }
    public function destroy(string $id)
    {
        try {
            $proveedor=Proveedor::find($id);
            if($proveedor==false){
                return response()->json([
                    "ok"=>false,
                    "error"=>"No se encontro",
                ]);
            }
            $proveedor->delete([]);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"se elimino con exito el proveedor",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok"=>false,
                "error"=>$ex->getMessage(),
            ]);

        }
        
    }
}
