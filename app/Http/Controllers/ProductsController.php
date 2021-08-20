<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;

class ProductsController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = products::get();

        return ['name'=>$reg];
    }
    
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = products::select('description')->get();
        }else{
        $reg = products::select('description')->where('id','=',$buscar)->get();
        }
        return ['reg'=>$reg];
    }

    public function store(Request $request)
    {
        $reg = new products;
        $reg->name = $request->name;
        $reg->description = $request->descrip;
        $reg->id_prod_category = $request->idProdCa;
        $reg->price = $request->price;
        $reg->state = $request->state;
        $reg->picture = $request->picture;
        $reg->save();
    }

    public function update(Request $request)
    {
        $reg = products::find($request->id);
        $reg->name = $request->name;
        $reg->description = $request->descrip;
        $reg->id_prod_category = $request->idProdCa;
        $reg->price = $request->price;
        $reg->state = $request->state;
        $reg->picture = $request->picture;
        $reg->save();
    }  

    public function destroy(Request $request)
    {
        $reg = products::findOrFail($request->id);
        $reg->delete();
    }
}
