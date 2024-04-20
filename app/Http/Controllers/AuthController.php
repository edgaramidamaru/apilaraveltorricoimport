<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $rules=[
            'name'=>'required',
            'password'=>'required|string'
        ];
        $req->validate($rules);
        $user=User::where('name',$req->name)->first();
        if($user && Hash::check($req->password,$user->password)){
            $token=$user->createToken('Personal Access Token')->plainTextToken;
            $response=['user'=>$user,'token'=>$token];
            return response()->json($response,200);
        }
        $response=["message"=>'nombre de usuario o password Incorrecto'];
        return response()->json($response,400);
    }
    
    public function register(Request $req)  
    {
        $rules=[
            'nombrecompleto'=>'required|string',
            'name'=>'required|string',
            'email'=>'required|string|unique:users',
            'password'=>'required|string|min:6',
            'cargo'=>'required|string'
        ];
        $validator=Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $user = User::create([
            'nombrecompleto'=>$req->nombrecompleto,
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'cargo'=>$req->cargo
        ]);
        $token=$user->createToken('Personal Access Token')->plainTextToken;
        $response=['user'=>$user,'token'=>$token];
        return response()->json($response,200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        return response()->json(['user' => $user], 200);
    }
    public function showto()
    {
        $user = User::all();
    
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        return response()->json(['user' => $user], 200);
    }
    public function update(Request $req, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $rules=[
            'nombrecompleto'=>'required|string',
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email,'.$id,
            'password'=>'required|string|min:6',
            'cargo'=>'required|string'
        ];
        $validator=Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $user->update([
            'nombrecompleto'=>$req->nombrecompleto,
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
            'cargo'=>$req->cargo
        ]);

        return response()->json(['message' => 'Usuario actualizado correctamente'], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
    }
}
