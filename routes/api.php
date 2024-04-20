<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//login
Route::post('/auth/login',[AuthController::class,'login'] );

//usuario
Route::post('/auth/register',[AuthController::class,'register'] );
Route::get('/auth/show/{id}',[AuthController::class,'show'] );

Route::get('/auth/showto',[AuthController::class,'showto'] );
Route::put('/auth/update/{id}',[AuthController::class,'update'] );
Route::delete('/auth/delete/{id}',[AuthController::class,'delete'] );


//proveedor
Route::post('/proveedor/store', [ProveedorController::class, 'store']);
Route::get('/proveedor/show/{id}', [ProveedorController::class, 'show']);
Route::get('/proveedor/showto', [ProveedorController::class, 'showto']);
Route::put('/proveedor/update/{id}', [ProveedorController::class, 'update']);
Route::delete('/proveedor/destroy/{id}', [ProveedorController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

