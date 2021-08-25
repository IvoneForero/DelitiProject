<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\deliveries;

class DeliveriesController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = deliveries::get();

        return ['id_domiciliary'=>$reg];
    }

    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = deliveries::select('price')->get();
        }else{
            $reg = deliveries::select('price')->where('id','=',$buscar)->get();
        }
        return ['price'=>$reg];
    }

    public function store(Request $request)
    {
        $reg = new deliveries;
        $reg->id_order = $request->idOrder;
        $reg->id_domiciliary = $request->idDomiciliary;
        $reg->state = $request->state;
        $reg->price= $request->price;
        $reg->save();
    }

    public function update(Request $request)
    {
        $reg = deliveries::find($request->id);
        $reg->id_order = $request->idOrder;
        $reg->id_domiciliary = $request->idDomiciliary;
        $reg->state = $request->state;
        $reg->price= $request->price;
        $reg->save();
    }

    public function destroy(Request $request)
    {
        $reg = deliveries::findOrFail($request->id);
        $reg->delete();
    }
}
