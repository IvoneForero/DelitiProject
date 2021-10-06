<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\type_users;
use Inertia\Inertia;

class TypeUsersController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = type_users::get();
        return Inertia::render('TipoUsuario',['consulta'=>$reg]);
    }
    
    public function index2(Request $request)
    {
        $reg = type_users::get();
        return ['consulta'=>$reg];
    }

    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        $reg = type_users::select('id','name')->OrderBy('name','asc')->get();
        return ['consulta'=>$reg];
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
