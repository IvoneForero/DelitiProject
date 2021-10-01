<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category_prods;
use Inertia\Inertia;

class CategoryProdsController extends Controller
{
    //
    public function index(Request $request)
    {
        $catprod = category_prods::get();
        return Inertia::render('Categoria',['categoria'=>$catprod]);
    }

    public function index2(Request $request)
    {
        $catprod = category_prods::get();
        return ['categoria'=>$catprod];
    }
    
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $catprod = category_prods::select('name')->get();
        }else{
             $catprod = category_prods::select('name')->where('id','=',$buscar)->get();
        }
        return ['catprod'=>$catprod];
    }

    public function store(Request $request)
    {
        $catpro = new category_prods;
        $catpro->name = $request->name;
        $catpro->description = $request->description;
        $catpro->state = $request->state;
        $catpro->save();
    }

    public function update(Request $request)
    {
        $catpro = category_prods::find($request->id);
        $catpro->name = $request->name;
        $catpro->description = $request->description;
        $catpro->status = $request->status;
        $catpro->save();
    }  

    public function destroy(Request $request)
    {
        $catprod = category_prods::findOrFail($request->id);
        $catprod->delete();
    }

}
