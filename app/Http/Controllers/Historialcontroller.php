<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Boleta;
use App\Cotizacion;
use Illuminate\Support\Facades\DB;
use App\Reparacion;
class HistorialController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;

        if($buscar==''){

            $reparacion= Reparacion::orderBy('id','desc')->where('estado',1)->paginate(3);

        } else{

            $reparacion= Reparacion::where($criterio,'like','%'.$buscar.'%')->where('estado',1)->orderBy('id','desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $reparacion->total(),
            'current_page'     => $reparacion->currentPage(),
            'per_page'         => $reparacion->perPage(),
            'last_page'        => $reparacion->lastPage(),
            'from'             => $reparacion->firstItem(),
            'to'               => $reparacion->lastItem(),
           
            ],

            'reparacion' =>$reparacion

        ];
    }
    public function indexcliente(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;
        $rut=$request->rut;
        if($buscar==''){

            $reparacion= Reparacion::orderBy('id','desc')->where('estado',1)->where('rut_cliente',$rut)->paginate(3);

        } else{

            $reparacion= Reparacion::where($criterio,'like','%'.$buscar.'%')->where('estado',1)->orderBy('id','desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $reparacion->total(),
            'current_page'     => $reparacion->currentPage(),
            'per_page'         => $reparacion->perPage(),
            'last_page'        => $reparacion->lastPage(),
            'from'             => $reparacion->firstItem(),
            'to'               => $reparacion->lastItem(),
           
            ],

            'reparacion' =>$reparacion

        ];
    }
    public function cotizaciones(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;

        if($buscar==''){

            $cotizacion= Cotizacion::orderBy('id','desc')->paginate(3);

        } else{

            $cotizacion= Cotizacion::where($criterio,'like','%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $cotizacion->total(),
            'current_page'     => $cotizacion->currentPage(),
            'per_page'         => $cotizacion->perPage(),
            'last_page'        => $cotizacion->lastPage(),
            'from'             => $cotizacion->firstItem(),
            'to'               => $cotizacion->lastItem(),
           
            ],

            'cotizacion' =>$cotizacion

        ];
    }

    public function cotizacionescliente(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;
        $rut=$request->rut;
        if($buscar==''){

            $cotizacion= Cotizacion::orderBy('id','desc')->where('rut_cliente',$rut)->paginate(3);

        } else{

            $cotizacion= Cotizacion::where($criterio,'like','%'.$buscar.'%')->where('rut_cliente',$rut)->orderBy('id','desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $cotizacion->total(),
            'current_page'     => $cotizacion->currentPage(),
            'per_page'         => $cotizacion->perPage(),
            'last_page'        => $cotizacion->lastPage(),
            'from'             => $cotizacion->firstItem(),
            'to'               => $cotizacion->lastItem(),
           
            ],

            'cotizacion' =>$cotizacion

        ];
    }


    public function historial(Request $request, $id){
        if(!$request->ajax()) return redirect('/');

        $buscar= $request->buscar;
        $criterio= $request->criterio;

        if($buscar==''){

            $reparacion= Reparacion::orderBy('id','desc')->paginate(3);

        } else{

            $reparacion= Reparacion::where($criterio,'like','%'.$buscar.'%')->orderBy('id','desc')->paginate(3);
        }

         
        return[

            'pagination' => [
            'total'            => $reparacion->total(),
            'current_page'     => $reparacion->currentPage(),
            'per_page'         => $reparacion->perPage(),
            'last_page'        => $reparacion->lastPage(),
            'from'             => $reparacion->firstItem(),
            'to'               => $reparacion->lastItem(),
           
            ],

            'reparacion' =>$reparacion

        ];
    }
    public function detalle($id){
        $sql="SELECT * FROM detalle_reparacion where id_reparacion='$id'";
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
