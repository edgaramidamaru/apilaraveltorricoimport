<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   
    public $table="cliente";
    protected $fillable=[
        'nombrecomcliente',
        'carnet',
        'celular',
        'direccion'
    ]; 
    public $timestamps=false;
}
