<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type_users;

class TypeUsersController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = type_users::get();

        return ['name'=>$reg];
    }
    
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = type_users::select('name')->get();
        }else{
            $reg = type_users::select('name')->where('id','=',$buscar)->get();
        }
        return ['reg'=>$reg];
    }

    public function store(Request $request)
    {
        $reg = new type_users;
        $reg->name = $request->nombre;
        $reg->save();
    }

    public function update(Request $request)
    {
        $reg = type_users::find($request->id);
        $reg->name = $request->nombre;
        $reg->save();
    }  

    public function destroy(Request $request)
    {
        $reg = type_users::findOrFail($request->id);
        $reg->delete();
    }
}
