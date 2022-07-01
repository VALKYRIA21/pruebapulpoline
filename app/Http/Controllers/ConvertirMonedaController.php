<?php

namespace App\Http\Controllers;

use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// Models
use App\Models\User;
use App\Models\HistorialDeConversionDeUsuario as HistorialConversion;


class ConvertirMonedaController extends Controller
{
    public function convertirMoneda(Request $request){
        // Comenzando conversion mediante la api
        // dd($request->all()); //test
        $idUsuario= $request->idUser;
        $fechaActual = Carbon::today();
        $fechaActual= $fechaActual->format('Y-m-d');
        /* Validacion del usuariousar el servicio de conversión máximo 5 veces, 
        si sobre pasa este límite lo debe redirigir a una pantalla donde le indique 
        que supere el límite de conversiones en un día.*/
        // Si no existe registro se crea una nueva instancia
        // Usando el ORM de Laravel
        $busquedaHistorialConversionUsuario = HistorialConversion::whereIdUsuario($idUsuario)->first();
        // dd($busquedaHistorialConversionUsuario); test
        if($busquedaHistorialConversionUsuario==null){
            // Creo una nueva instancia
            $historialConversionUsuario = new HistorialConversion;
            $historialConversionUsuario->id_usuario = $idUsuario;
            $historialConversionUsuario->numero_conversiones = 1;
            $historialConversionUsuario->fecha = $fechaActual;
            $historialConversionUsuario->save();
            // apikey
            $apiKey = '772831bfdf6210ee6d51';
            // Siguiendo ejemplo de la documentacion
            $from_Currency = urlencode($request->deMoneda);
            $to_Currency = urlencode($request->aMoneda);
            $query =  "{$from_Currency}_{$to_Currency}";
            //Consulta a la api mediante la url free
            $json = Http::get("https:/free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apiKey}");
            // retorno de la consulta a la api
            $obj = json_decode($json, true);
            // dd($obj); test
            $val = floatval($obj["$query"]);
            $total = $val * $request->montoConver;
            $mensajeFinal = $request->montoConver.' '.$request->deMoneda.', Equivalen a = '.number_format($total, 2, '.', '').' '.$request->aMoneda;
            // Envio el monto convertido
            Session::flash('monto_convertido',$mensajeFinal);
            return back();
        }else {
            $busquedaHistorialConversionUsuario = HistorialConversion::whereIdUsuario($idUsuario)->first();
            $fechaGuardada= $busquedaHistorialConversionUsuario->updated_at;
            $numeroDeConversiones = $busquedaHistorialConversionUsuario->numero_conversiones;
            // Le doy un formato adecuado para realizar la validacion
            $fechaGuardada = $fechaGuardada->format( 'Y-m-d');
            if($fechaGuardada!=$fechaActual){
                $contadorConversion = HistorialConversion::whereIdUsuario($idUsuario)->update(['numero_conversiones'=> 0]);
                $busquedaHistorialConversionUsuario = HistorialConversion::whereIdUsuario($idUsuario)->first();
                $numeroDeConversiones = $busquedaHistorialConversionUsuario->numero_conversiones;
                $numeroDeConversiones +=1;
                $contadorConversion = HistorialConversion::whereIdUsuario($idUsuario)->update(['numero_conversiones'=> $numeroDeConversiones]);
                //apikey
                $apiKey = '772831bfdf6210ee6d51';
                // Siguiendo ejemplo de la documentacion
                $from_Currency = urlencode($request->deMoneda);
                $to_Currency = urlencode($request->aMoneda);
                $query =  "{$from_Currency}_{$to_Currency}";
                //Consulta a la api mediante la url free
                $json = Http::get("https:/free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apiKey}");
                // retorno de la consulta a la api
                $obj = json_decode($json, true);
                // dd($obj); test
                $val = floatval($obj["$query"]);
                $total = $val * $request->montoConver;
                $mensajeFinal = $request->montoConver.' '.$request->deMoneda.', Equivalen a = '.number_format($total, 2, '.', '').' '.$request->aMoneda;
                Session::flash('monto_convertido',$mensajeFinal);
                return back();
            }
            else{
                if($numeroDeConversiones == 5 ){
                    Session::flash('numero_de_conversiones_alcanzadas', 'Usted alcanzó el número de conversiones por el día de hoy');
                    return back();
                }
                else{
                    $numeroDeConversiones +=1;
                    $contadorConversion = HistorialConversion::whereIdUsuario($idUsuario)->update(['numero_conversiones'=> $numeroDeConversiones]);
                    //apikey
                    $apiKey = '772831bfdf6210ee6d51';
                    // Siguiendo ejemplo de la documentacion
                    $from_Currency = urlencode($request->deMoneda);
                    $to_Currency = urlencode($request->aMoneda);
                    $query =  "{$from_Currency}_{$to_Currency}";
                    //Consulta a la api mediante la url free
                    $json = Http::get("https:/free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apiKey}");
                    // retorno de la consulta a la api
                    $obj = json_decode($json, true);
                    // dd($obj); test
                    $val = floatval($obj["$query"]);
                    $total = $val * $request->montoConver;
                    $mensajeFinal = $request->montoConver.' '.$request->deMoneda.', Equivalen a = '.number_format($total, 2, '.', '').' '.$request->aMoneda;
                    Session::flash('monto_convertido',$mensajeFinal);
                    return back();
                }
            }
        }
    }
}
