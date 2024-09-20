<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    public $table="pedidos";
    protected $fillable=[
        'nombreproducto',
        'descripcionproducto',
        'cantidad',
        'nombreprovedor',
    ];
    public $timestamps=false;

}
