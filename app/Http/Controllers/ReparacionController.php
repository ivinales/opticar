<?php

namespace App\Http\Controllers;

use App\DetalleReparacion;
use Illuminate\Http\Request;
use App\Message;
use App\Reparacion;
use App\Cliente;
use App\DetalleCotizacion;
use App\Http\Resources\Reparacion as ReparacionResource;
use App\vehiculo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


use App\Jobs\SendMailJob;
use App\Mail\NewArrivals;


class ReparacionController extends Controller
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

            $reparaciones= Reparacion::all();

        } else{

            $reparaciones= Reparacion::all()->where($criterio,$buscar);
        }

         
        return $reparaciones;
    }
        
   
    public function  detallereparacion(Request $request)
    {
        
        // if(!$request->ajax()) return redirect('/');

        $id= $request->criterio;


            $detalle= DetalleReparacion::all()->where('id_reparacion',$id);



         
        return $detalle;
    }
    public function  detallecotizacion(Request $request)
    {
        
        // if(!$request->ajax()) return redirect('/');

        $id= $request->criterio;


            $detalle= DetalleCotizacion::all()->where('id_cotizacion',$id);



         
        return $detalle;
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
        $reparacion = new Reparacion();

        $reparacion->rut_cliente = $request->rutboleta;
        $reparacion->monto_total = $request->totalboleta;
        $reparacion->patente_vehiculo = $request->patentevehiculo;

        if ($reparacion->save()) {
            // $productos = json_decode($request->productos);
            $productos=$request->productos;
            $object = json_decode(json_encode($productos), FALSE);
            foreach ($object as $producto) {
                $dc = new DetalleReparacion();
                $dc->id_reparacion = $reparacion->id;
                $dc->repuesto = $producto->resp;
                $dc->costo = $producto->cost;
                $dc->observacion = $producto->obs;
                $dc->mantencion = $producto->mant;
                $dc->estado = 'Reposo';
                $dc->save();
            }

           
        }
        $now = date("Y", strtotime(Carbon::now()));
        logger($now);


        $vehiculo= vehiculo::where('patente',$request->patentevehiculo)->first();
        $kilometraje=$vehiculo->kilometraje;
        $aceite=$vehiculo->aceite;
        $año_vehiculo=$vehiculo->anio;

       
            $dias=(10000- ($kilometraje-$aceite))/(($kilometraje/($now-$año_vehiculo))/365 );     
            $now2 = date("Y-m-d H:i", strtotime(Carbon::now()->addDays($dias)));
            logger($now2);
    
        if($now>$now2){
            
            $now3 = date("Y-m-d H:i", strtotime(Carbon::now()->addMinute(5)));
         logger($now3);
        
            $cliente= Cliente::where('num_documento',$request->rutboleta)->first();
        $message= new Message();
        $message->title='Aviso de falla a futuro';
        $message->body='se le recomienda realizar cambio de aceite';
        $message->delivered='NO';
        $message->email= $cliente->email;
        $message->date_string=$now3;
        $message->send_date=$now3;
        $message->save();
        }else{
            $cliente= Cliente::where('num_documento',$request->rutboleta)->first();
        $message= new Message();
        $message->title='Aviso de falla a futuro';
        $message->body='se le recomienda realizar cambio de aceite';
        $message->delivered='NO';
        $message->email= $cliente->email;
        $message->date_string=$now2;
        $message->send_date=$now2;
        $message->save();
        }

        

    }
    public function detalle($id){
        $sql="SELECT * FROM detalle_reparacion where id_reparacion='$id'";
        $data = DB::select($sql);
        return compact('data');
    }
    public function getReparaciones(){
        
        return  new ReparacionResource(Reparacion::all()->where('estado','=',0));

    }
     public function getReparacionescli(Request $request ){
        
        return  new ReparacionResource(Reparacion::all()->where('estado','=',0)->where('rut_cliente',$request->rut));

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
    public function updateReparacion(Request $request,$id){
        $detallereparacion = DetalleReparacion::find($id);
        $detallereparacion->estado=$request->estado;
        $detallereparacion->save();
        return response()->json($detallereparacion);

    
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
