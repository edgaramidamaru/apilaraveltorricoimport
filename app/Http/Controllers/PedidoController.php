<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedidos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedido=Pedidos::select("pedidos.*")->get()->toArray();
        return response()->json($pedido);
    }

    public function create()
    {
    }
    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombreproducto'=>'required',
            'descripcionproducto'=>'required',
            'cantidad'=>'required',
            'nombreprovedor'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        }try{
            Pedidos::create($input);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"Se registro con exito la orden de pedido",
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "ok"=>false,
                "error"=>$ex->getMessage(),
            ]);
        }
    }

    public function show(string $id)
    {
        $pedido=Pedidos::select("pedidos.*")->where("pedidos.id",$id)->first();
        return response()->json(["ok"=>true,"data"=>$pedido,]);
    }
    public function showto(){
        $pedido=Pedidos::all();
        return response()->json(["ok"=>true,"data"=>$pedido,]);
    }
    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombreproducto'=>'required',
            'descripcionproducto'=>'required',
            'cantidad'=>'required',
            'nombreprovedor'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        }try{
            $pedido=Pedidos::find($id);
            if($pedido==false){
                return response()->json(["ok"=>false,"mensaje"=>"No se encontro",]);
            }
            $pedido->update($input);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"Se modifico con exito el pedido"
            ]);}catch(\Exception $ex){
                return response()->json([
                    "ok"=>false,
                    "error"=>$ex->getMessage(),
                ]);
            }
        }

    
    public function destroy(string $id)
    {
        try {
            $pedido=Pedidos::find($id);
            if($pedido==false){
                return response()->json(["ok"=>false,"error"=>"No se encontro",]);
            }
            $pedido->delete([]);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"se elimino con exito el pedido"
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "ok"=>false,
                "error"=>$ex->getMessage(),
            ]);
        }
    }
}
