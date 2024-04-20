<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    public $table="proveedor";
    protected $fillable=[
        'nombreempresa',
        'razonsocial',
        'nombreproveedor',
        'numcontacto'
    ]; 
    public $timestamps=false;
}
