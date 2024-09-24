<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ventas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function index(){
        $venta=Ventas::select("ventas.*")->get()->toArray();return response()->json($venta);
    }
    public function create (){}
    public function store(Request $request){ $input=$request->all();$validator=Validator::make($input,[ 'nombrecliente'=>'required',
        'nombreproducto'=>'required',
        'precio'=>'required']);if($validator->fails()){return response()->json(['ok'=>false,'error'=>$validator->messages(),]);}try{Ventas::create($input);return response()->json(["ok"=>true,"mensaje"=>"se registro la venta con exito",]);}catch(\Exception $ex){return response()->json(["ok"=>false,"error"=>$ex->getMessage(),]);}}
public function show(string $id){$venta=Ventas::select("ventas.*")->where("ventas.id",$id)->first();return response()->json(["ok"=>true,"data"=>$venta,]);}
public function showto(){$venta=Ventas::all();return response()->json(["ok"=>true,"data"=>$venta,]);}
public function edit(string $id){}
public function update(Request $request,string $id){
    $input=$request->all();
    $validator=validator::make($input,[
        'nombrecliente'=>'required',
        'nombreproducto'=>'required',
        'precio'=>'required']);
        if($validator->fails()){return response ()->json(['ok'=>false,'error'=>$validator->messages(),]);}
        try{$venta=Ventas::find($id);
        if($venta==false){  return response()->json(["ok"=>false,"mensaje"=>"No se encontro",]);
        }
        $venta->update($input);
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
            $venta=Ventas::find($id);
            if($venta==false){
                return response()->json(["ok"=>false,"error"=>"No se encontro",]);
            }
            $venta->delete([]);
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
