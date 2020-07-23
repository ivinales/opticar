<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\vehiculo;
use Illuminate\Support\Facades\Mail;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;

        if($buscar==''){

            $vehiculo= vehiculo::orderBy('id','desc')->paginate(3);

        } else{

            $vehiculo= vehiculo::where($criterio,'like','%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $vehiculo->total(),
            'current_page'     => $vehiculo->currentPage(),
            'per_page'         => $vehiculo->perPage(),
            'last_page'        => $vehiculo->lastPage(),
            'from'             => $vehiculo->firstItem(),
            'to'               => $vehiculo->lastItem(),
           
            ],

            'vehiculo' =>$vehiculo

        ];
       
    }
    public function crear(Request $request){
        

      
        // return compact('wea');


    }
    public function buscarauto(Request $request,$id){
        $sql="SELECT marca,modeloVehiculo,patente,anio,kilometraje FROM vehiculo where patente='$id'";
        $data = DB::select($sql);
        return compact('data');
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
        if(!$request->ajax()) return redirect('/');

        $vehiculo=new vehiculo();
        $vehiculo->patente=$request->patente;
        $vehiculo->kilometraje=$request->kilometraje;
        $vehiculo->anio=$request->anio;
        $vehiculo->marca=$request->marca;
        $vehiculo->modeloVehiculo=$request->modelo;
        $vehiculo->estado='1';
        $vehiculo->save();
        

        $data = array(
            'name' => "Curso Laravel",
        );
    
        Mail::send('emails.welcome', $data, function ($message) {
    
            $message->from('opticar.tesis@gmail.com', 'Curso Laravel');
    
            $message->to('opticar.tesis@gmail.com')->subject('test email Curso Laravel');
    
        });
    
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
        if(!$request->ajax()) return redirect('/');
        $vehiculo= vehiculo::findOrFail($request->id);
        $vehiculo->patente=$request->patente;
        $vehiculo->kilometraje=$request->kilometraje;
        $vehiculo->anio=$request->anio;
        $vehiculo->marca=$request->marca;
        $vehiculo->modeloVehiculo=$request->modelo;
        $vehiculo->save();
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

    public function desactivar(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $vehiculo= Vehiculo::findOrFail($request->id);
        $vehiculo->estado= '0';
        $vehiculo->save();
    }

    public function activar(Request $request)
    {
        //
        if(!$request->ajax()) return redirect('/');
        $vehiculo= Vehiculo::findOrFail($request->id);
        $vehiculo->estado= '1';
        $vehiculo->save();
    }
}
