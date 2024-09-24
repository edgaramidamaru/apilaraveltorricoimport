<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    public $table="ventas";
    protected $fillable=[
        'nombrecliente',
        'nombreproducto',
        'precio'
    ];
    public $timestamps=false;
}
