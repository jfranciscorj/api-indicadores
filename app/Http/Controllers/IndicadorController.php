<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndicador;
use App\Http\Requests\UpdateIndicador;
use App\Models\Indicador;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Nette\Utils\Arrays;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class IndicadorController extends Controller
{

    public function __construct(){
        $this->middleware('can:indicadores.index')->only('index' );
        $this->middleware('can:indicadores.index')->only('show');
        $this->middleware('can:indicadores.create')->only('create', 'store');
        $this->middleware('can:indicadores.edit')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("indicadores.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("indicadores.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndicador $request)
    {
        //

        $indicador = new Indicador();

        $indicador->nombreIndicador = $request->nombreIndicador;
        $indicador->codigoIndicador = $request->codigoIndicador;
        $indicador->unidadMedidaIndicador = $request->unidadMedidaIndicador;
        $indicador->valorIndicador = $request->valorIndicador;
        $indicador->fechaIndicador = $request->fechaIndicador;
        $indicador->tiempoIndicador = $request->tiempoIndicador;
        $indicador->origenIndicador = $request->origenIndicador;

        $indicador->save();

        $codigo = $indicador->codigoIndicador;

        return redirect()->route('indicadores.show', $codigo)->with('success', "El indicador se ha creado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($codigoIndicador)
    {
        //
        $indicadores = Indicador::where('codigoIndicador', $codigoIndicador)
        ->orderBy('fechaIndicador', 'asc')
        ->get();

        if($indicadores->count() == 0){
            //return redirect()->route('indicadores.index');
            abort('404');
        }

        return view("indicadores.show", compact('codigoIndicador', 'indicadores'));
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
        $detalle = Indicador::find($id)->get();

        return view('indicadores.edit', compact('detalle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIndicador $request, $id)
    {
        //
        $detalle = Indicador::find($id);

        if(!$detalle){
            abort(404);
        }

        $detalle->nombreIndicador = $request->nombreIndicador;
        $detalle->codigoIndicador = $request->codigoIndicador;
        $detalle->unidadMedidaIndicador = $request->unidadMedidaIndicador;
        $detalle->valorIndicador = $request->valorIndicador;
        $detalle->fechaIndicador = $request->fechaIndicador;
        $detalle->tiempoIndicador = $request->tiempoIndicador;
        $detalle->origenIndicador = $request->origenIndicador;

        $detalle->save();

        $codigoIndicador = $detalle->codigoIndicador;
        $url = '/indicadores/'.$codigoIndicador.'/'.$id;

        return redirect($url)->with('success', "El indicador se ha modificado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($codigo, $id)
    {
        //

        $registro = Indicador::findOrFail($id);
        $registro->delete();

        return redirect()->route('indicadores.show', $codigo)->with('success', "El registro se ha eliminado exitosamente");
    }

    public function detalleIndicador($codigoIndicador, $idIndicador){

        $detalle = Indicador::where('codigoIndicador', $codigoIndicador)
        ->where('id', $idIndicador)
        ->first();

        if(!$detalle){
            abort(404);
        }

        return view("indicadores.edit", compact('detalle'));
    }
    
    public function consultaIndicador(Request $request, $codigoIndicador){

        if($request->fechaIndicadorMin >= $request->fechaIndicadorMax){
            return redirect()->back()->with('message', 'La fecha de inicio no puede ser mayor a la fecha de fin'); 
        }     

        $indicadores = Indicador::where('codigoIndicador', $codigoIndicador)
        ->whereBetween('fechaIndicador', [$request->fechaIndicadorMin,$request->fechaIndicadorMax])
        ->get();

        if($indicadores->count() == 0){
            return redirect()->back()->with('message', 'No se encontraron registros'); 
        }

        return view("indicadores.show", compact('codigoIndicador', 'indicadores'));
    }
    
    public function indicadores(){
        
        $codigos = Indicador::select('codigoIndicador')
        ->groupByRaw('codigoIndicador')
        ->get();

        $collection = collect();

        foreach($codigos as $codigo){

            $a = Indicador::Where('codigoIndicador', $codigo->codigoIndicador)
            ->orderBy('fechaIndicador', 'desc')
            ->limit(2)
            ->get();

            if($a->count() >= 2){

                $calculo = $a[0]->valorIndicador - $a[1]->valorIndicador;

                // $a = Indicador::Where('codigoIndicador', $codigo->codigoIndicador)
                // ->orderBy('fechaIndicador', 'desc')
                // ->first();

                $a[0]->calculo = $calculo;
                $a[0]->fechaIndicador = Carbon::parse($a[0]->fechaIndicador)->format('d-m-Y');

            }

            if($a[0]->unidadMedidaIndicador == "Pesos"){
                $a[0]->valorIndicador = '$'.number_format(($a[0]->valorIndicador), 0, ',', '.');
            }

            if($a[0]->unidadMedidaIndicador == "Dólar"){
                $a[0]->valorIndicador = 'US '.number_format(($a[0]->valorIndicador), 0, ',', '.');
            }

            if($a[0]->unidadMedidaIndicador == "Porcentaje"){
                $a[0]->valorIndicador = $a[0]->valorIndicador.'%';
            }

            
            $collection->push($a[0]);

        }

        //dd($collection);


        return $collection;

    }
    
    public function dataIndicador($codigoIndicador){
            
        $indicador = Indicador::select('valorIndicador', 'fechaIndicador')
        ->Where('codigoIndicador', $codigoIndicador)
        ->orderBy('fechaIndicador', 'desc')
        ->get();

        return $indicador;

    }
    
    public function nuevo(Request $request)
    {
        //

        $validator = Validator::make($request->all(), [
            "nombreIndicador" => "required|max:50",
            "codigoIndicador" => "required|max:50",
            "unidadMedidaIndicador" => "required|max:50",
            "valorIndicador" => "required|numeric",
            "fechaIndicador" => "required|max:50|date",
            "tiempoIndicador" => "nullable|max:50",
            "origenIndicador" => "required|max:50"
        ]);

        //devuelvo listado de errores
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors;
        }

        $indicador = new Indicador();

        $indicador->nombreIndicador = $request->nombreIndicador;
        $indicador->codigoIndicador = $request->codigoIndicador;
        $indicador->unidadMedidaIndicador = $request->unidadMedidaIndicador;
        $indicador->valorIndicador = $request->valorIndicador;
        $indicador->fechaIndicador = $request->fechaIndicador;
        $indicador->tiempoIndicador = $request->tiempoIndicador;
        $indicador->origenIndicador = $request->origenIndicador;

        $indicador->save();

        return $indicador;
    }

}
