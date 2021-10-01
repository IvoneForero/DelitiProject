<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doc_types;
use Inertia\Inertia;

class DocTypesController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = doc_types::get();
        return Inertia::render('TipoDoc',['consulta'=>$reg]);
    }

    public function index2(Request $request)
    {
        $reg = doc_types::get();
        return ['consulta'=>$reg];
    }
    
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = doc_types::select('doc_type')->get();
        }else{
             $reg = doc_types::select('doc_type')->where('id','=',$buscar)->get();
        }
        return ['reg'=>$reg];
    }

    public function store(Request $request)
    {
        $reg = new doc_types;
        $reg->doc_type = $request->tipo;
        $reg->save();
    }

    public function update(Request $request)
    {
        $reg = doc_types::find($request->id);
        $reg->doc_type = $request->tipo;
        $reg->save();
    }  

    public function destroy(Request $request)
    {
        $reg = doc_types::findOrFail($request->id);
        $reg->delete();
    }
}
