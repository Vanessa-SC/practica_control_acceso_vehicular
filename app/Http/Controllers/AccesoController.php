<?php

namespace App\Http\Controllers;

use App\Models\Acceso;
use App\Models\Estancia;
use App\Models\TipoVehiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class AccesoController extends Controller
{
    public function index()
    {
        return view('accesos/index');
    }

    public function entrada()
    {
        $tipos = TipoVehiculo::all();
        return view('accesos/entrada', compact('tipos'));
    }

    public function salida()
    {
        $vehiculos = Estancia::with('acceso')->where('hora_salida', '=', null)->get();
        return view('accesos/salida', compact('vehiculos'));
    }


    public function store_entrada(Request $request)
    {
        try{
            $transaction = DB::transaction(function () use ($request) {
                $acceso = Acceso::create([
                    'placas' => $request->num_placas,
                    'tipo_id' => $request->tipo
                ]);

                $estancia = new Estancia();
                $estancia->acceso_id = $acceso->id;
                $estancia->hora_entrada = Carbon::now();
                $estancia->save();

                return $acceso->id;
            });
            
            return redirect()->route('accesos.index')
                    ->with('success', 'Entrada registrada con éxito');
            
        }catch (\Exception $e){
            return redirect()->route('accesos.index')
                    ->with('error', 'Ocurrió un error al registrar la entrada')
                    ->with('mensaje', $e->getMessage());
        }
        
    }

    public function store_salida(Request $request)
    {
        try{
            $transaction = DB::transaction(function () use ($request) {
                $estancia = Estancia::find($request->estancia_id);
                $acceso = Acceso::find($estancia->acceso_id);
                $tipo = TipoVehiculo::find($acceso->tipo_id);


                $estancia->hora_salida = date('Y-m-d H:i:s');
                $estancia->save();

                $importe = 0;

                if($tipo->id != 1) {
                    $minutos = $this->minutos_transcurridos($estancia->hora_entrada, $estancia->hora_salida);

                    $importe = $tipo->cuota * $minutos;
                }

                return $importe;
            });
            
            if($transaction == 0){
                return redirect()->route('accesos.index')
                    ->with('success', 'Salida registrada con éxito');
            } else {
                return redirect()->route('accesos.index')
                    ->with('success', 'Salida registrada. El importe a cobrar es: $'.number_format($transaction,2));
            }
            
        }catch (\Exception $e){
            return redirect()->route('accesos.index')
                    ->with('error', 'Ocurrió un error al registrar la salida')
                    ->with('mensaje', $e->getMessage());
        }
    }

    public function reporte(Request $request) {

        if($request->fecha){

            $fecha = $request->fecha;
            $hora = $request->hora;
    
            $accesos = DB::select(
                DB::raw(
                    "SELECT a.placas, e.hora_entrada, e.hora_salida, t.tipo, t.cuota 
                    FROM accesos a, estancias e, tipo_vehiculos t 
                    WHERE a.tipo_id = t.id 
                    AND e.acceso_id = a.id
                    AND (e.hora_entrada LIKE '%".$fecha." ".$hora."%' 
                        OR e.hora_salida LIKE '%".$fecha." ".$hora."%')
                    ORDER BY a.id
                "));
        } else {
            
        $accesos = DB::select(
                    DB::raw(
                        "SELECT a.placas, e.hora_entrada, e.hora_salida, t.tipo, t.cuota 
                        FROM accesos a, estancias e, tipo_vehiculos t 
                        WHERE a.tipo_id = t.id 
                        AND e.acceso_id = a.id 
                        ORDER BY a.id
                    "));
        
        }
        foreach ($accesos as $acceso) {
            $entrada = $acceso->hora_entrada;
            $salida = is_null($acceso->hora_salida) ? date('Y-m-d H:i:s') : $acceso->hora_salida;
            $minutos = $this->minutos_transcurridos($entrada,$salida);
            
            if($minutos < 60) {
                $acceso->tiempo = $minutos.' min';
            } else {
                $acceso->tiempo = $this->minutos_a_horas($minutos);
            }
            $acceso->pago = $minutos * $acceso->cuota;
        }
        return view('accesos.reporte', compact('accesos'));
    }


    public function minutos_transcurridos($fecha1, $fecha2) {
        $horas = strtotime($fecha1)-strtotime($fecha2);
        $minutos = $horas/60;
        $minutos = abs($minutos);
        $minutos = floor($minutos);
        return $minutos;
    }

    public function minutos_a_horas($minutos){
        $horas = floor($minutos/60);
        $min = $minutos % 60;
        return $horas . ' hrs '. $min . ' min';
    }
}
