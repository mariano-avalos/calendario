<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmacion extends Model
{
     use HasFactory; //validacion de campos eventos

    static $rules=[    

        'nombre'=>'required',
        'apellido'=>'required',
        'email'=>'required',
        'cuidad'=>'required',
        'telefono'=>'required',

    ];


    protected $fillable= ['nombre','apellido','email','cuidad','telefono']; //ayuda a distingir los datos en los que se trabaja
}
