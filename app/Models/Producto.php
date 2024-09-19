<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $table="productos";
    protected $fillable=[
        'nombreproducto',
        'descripcion',
        'unidad',
        'existencia',
        'costo'
    ];
    public $timestamps=false;
}
