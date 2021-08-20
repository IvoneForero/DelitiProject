<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\app_users;

class AppUsersController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = app_users::get();

        return ['names'=>$reg];
    }
    
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = app_users::select('names')->get();
        }else{
            $reg = app_users::select('names')->where('id','=',$buscar)->get();
        }
        return ['reg'=>$reg];
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
