<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\app_users;
use Inertia\Inertia;

class AppUsersController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = app_users::join('doc_types','app_users.doc_type','doc_types.id')
        ->join('type_users','app_users.id_type_user','type_users.id')
        ->select('app_users.id', 'doc_types.id as idDoc', 'doc_types.doc_type as type','app_users.doc_num','app_users.names','app_users.surnames','app_users.phone','app_users.address','app_users.email', 'type_users.id as idUser', 'type_users.name as tip_user')
        ->get();
        return Inertia::render('Usuario',['consulta'=>$reg]);
    }

    public function index2(Request $request)
    {
        $reg = app_users::join('doc_types','app_users.doc_type','doc_types.id')
        ->join('type_users','app_users.id_type_user','type_users.id')
        ->select('app_users.id', 'doc_types.id as idDoc', 'doc_types.doc_type as type','app_users.doc_num','app_users.names','app_users.surnames','app_users.phone','app_users.address','app_users.email', 'type_users.id as idUser', 'type_users.name as tip_user')
        ->get();
        return ['consulta'=>$reg];
    }    
    
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = app_users::select('names')->get();
        }else{
            $reg = app_users::select('names')->where('id','=',$buscar)->get();
        }
        return ['consulta'=>$reg];
    }

    public function store(Request $request)
    {
        $reg = new app_users;
        $reg->doc_type = $request->doc_type;
        $reg->doc_num = $request->doc_num;
        $reg->names = $request->names;
        $reg->surnames = $request->surnames;
        $reg->phone = $request->phone;
        $reg->address = $request->address;
        $reg->email = $request->email;
        $reg->id_type_user = $request->id_type_user;
        $reg->save();
    }

    public function update(Request $request)
    {
        $reg = app_users::find($request->id);
        $reg->doc_type = $request->doc_type;
        $reg->doc_num = $request->doc_num;
        $reg->names = $request->names;
        $reg->surnames = $request->surnames;
        $reg->phone = $request->phone;
        $reg->address = $request->address;
        $reg->email = $request->email;    
        $reg->id_type_user = $request->id_type_user;            
        $reg->save();
    }  

    public function destroy(Request $request)
    {
        $reg = app_users::findOrFail($request->id);
        $reg->delete();
    }

}
