<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory; //validacion de campos eventos

    static $rules=[    

    	'title'=>'required',
    	'descripcion'=>'required',
    	'start'=>'required',
    	'end'=>'required',

    ];


    protected $fillable= ['title','descripcion','start','end']; //ayuda a distingir los datos en los que se trabaja




}
