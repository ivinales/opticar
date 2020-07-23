<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cotizacion;
use App\DetalleCotizacion;
class CotizacionController extends Controller
{
    public function store(Request $request)
    {
        $cotizacion = new Cotizacion();

        // $boleta->cliente = $request->nombre;
        // $boleta->monto_total = $request->direccion;
        $cotizacion->rut_cliente = $request->rutboleta;
        $cotizacion->monto_total = $request->totalboleta;
        $cotizacion->patente_vehiculo = $request->patentevehiculo;

        if ($cotizacion->save()) {
            // $productos = json_decode($request->productos);
            $productos=$request->productos;
            $object = json_decode(json_encode($productos), FALSE);
            foreach ($object as $producto) {
                $dc = new DetalleCotizacion();
                $dc->id_cotizacion = $cotizacion->id;
                $dc->repuesto = $producto->resp;
                $dc->costo = $producto->cost;
                $dc->observacion = $producto->obs;
                $dc->mantencion = $producto->mant;
                $dc->save();
            return;
        }

    }

}
}
