<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $cliente=Cliente::select("cliente.*")->get()->toArray();
        return response()->json($cliente);
    }
     public function create()
    {
    }
    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombrecomcliente'=>'required',
            'carnet'=>'nullable',
            'celular'=>'nullable|numeric',
            'direccion'=>'nullable',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        } try {
            Cliente::create($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Se registro con exito al Cliente",
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
        $cliente=Cliente::select("cliente.*")->where("cliente.id",$id)->first();
        return response()->json(["ok"=>true,"data"=>$cliente,]);
    
    }
    public function showto(){
        $cliente=Cliente::all();
        return response()->json(["ok"=>true,"data"=>$cliente,]);
    }
    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombrecomcliente'=>'nullable',
            'carnet'=>'nullable',
            'celular'=>'nullable|numeric',
            'direccion'=>'nullable',
        ]);
        if($validator->fails()){
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        }try{
            $cliente=Cliente::find($id);
            if($cliente==false){
                return response()->json([
                    "ok"=>false,
                    "mensaje"=>"No se encontro",
                ]);
            }
            $cliente->update($input);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"Se modifico con exito al Cliente"
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "ok"=>false,
                "error"=>$ex->getMessage(),
            ]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $cliente=Cliente::find($id);
            if($cliente==false){
                return response()->json(["ok"=>false,"error"=>"No se encontro",]);
            }
            $cliente->delete([]);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"se elimino con exito al cliente"
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "ok"=>false,
                "error"=>$ex->getMessage(),
            ]);
        }
    }
}
