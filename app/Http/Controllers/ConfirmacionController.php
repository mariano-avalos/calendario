<?php

namespace App\Http\Controllers;

use App\Models\Confirmacion;
use Illuminate\Http\Request;

use Carbon\Carbon; //ayuda a darle formato a varios datos

class ConfirmacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confirmacions = Confirmacion::latest()->paginate(5);
    
        return view('confirmacion.index',compact('confirmacions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Confirmacion::$rules); //valida que la info sea correcta
        $evento=Confirmacion::create($request->all()); //que cree la info con todos los datos que llega
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function show(Confirmacion $confirmacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Confirmacion $confirmacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Confirmacion $confirmacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Confirmacion  $confirmacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Confirmacion $confirmacion)
    {
        //
    }
}
