<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $producto=Producto::select("productos.*")->get()->toArray();
        return response()->json($producto);
    }

    public function create()
    {
    }
    public function store(Request $request)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombreproducto'=>'required',
            'descripcion'=>'required',
            'unidad'=>'required',
            'existencia'=>'required|numeric',
            'costo'=>'required|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        }try{
            Producto::create($input);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"Se registro con exito el producto",
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
        $producto=Producto::select("productos.*")->where("productos.id",$id)->first();
        return response()->json(["ok"=>true,"data"=>$producto,]);
    }
    public function showto(){
        $producto=Producto::all();
        return response()->json(["ok"=>true,"data"=>$producto,]);
    }
    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
        $input=$request->all();
        $validator=Validator::make($input,[
            'nombreproducto'=>'nullable',
            'descripcion'=>'nullable',
            'unidad'=>'nullable',
            'existencia'=>'nullable|numeric',
            'costo'=>'nullable|numeric'
        ]);
        if($validator->fails()){
            return response()->json([
                'ok'=>false,
                'error'=>$validator->messages(),
            ]);
        }try{
            $producto=Producto::find($id);
            if($producto==false){
                return response()->json(["ok"=>false,"mensaje"=>"No se encontro",]);
            }
            $producto->update($input);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"Se modifico con exito el producto"
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
            $producto=Producto::find($id);
            if($producto==false){
                return response()->json(["ok"=>false,"error"=>"No se encontro",]);
            }
            $producto->delete([]);
            return response()->json([
                "ok"=>true,
                "mensaje"=>"se elimino con exito el producto"
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "ok"=>false,
                "error"=>$ex->getMessage(),
            ]);
        }
    }
}
