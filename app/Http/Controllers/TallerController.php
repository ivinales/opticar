<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Taller;
use App\TallerUser;

use function GuzzleHttp\Promise\all;

class TallerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $taller = Taller::orderBy('id','desc')->get();
       return $taller;
    }
    
    public function selectTaller(Request $request){
        
        $taller = Taller::
        select('id','nombre')
        ->orderBy('nombre','asc')->get();

        return ['taller' => $taller];
    }

    
    public function tallermecanico(Request $request){
        $buscar= $request->id_cuenta;
            $criterio= 'user_id';

        $talleruser = TallerUser::join('users', 'users.id', '=', 'taller_user.user_id')
        ->join('taller', 'taller.id' , '=', 'taller_user.taller_id')
        ->select('taller.nombre','taller.direccion','taller.estado','taller.id','users.num_documento','users.nombre','users.email')
        ->where('taller_user.'.$criterio, 'like', '%'. $buscar . '%')
        ->orderBy('taller_user.id', 'desc')->get();

                return $talleruser;
                
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
        $taller = new Taller;

        $taller->nombre = $request->nombre;
        $taller->direccion = $request->direccion;
        $taller->color = 'a';
        $taller->estado = '1';
        $taller->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $taller = Taller::findOrFail($request->id);
        $taller->nombre = $request->nombre;
        $taller->direccion = $request->direccion;
        $taller->color = $request->color;
        $taller->estado = $request->estado;
        $taller->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
