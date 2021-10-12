<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ord_details;
use Inertia\Inertia;

class OrdDetailsController extends Controller
{
    public function index2(Request $request)
    {
        $reg = ord_details::get();
        return ['consulta'=>$reg];
    }    
    //
    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = ord_details::select('id','id_order','product_code','units','unit_price','total')->get();
        }else{
            $reg = ord_details::join('products','ord_details.product_code','products.id')
            ->select('ord_details.id as id_detail','id_order','product_code','products.name','units','unit_price','total')->where('id_order','=',$buscar)->get();
        }
        return ['consulta'=>$reg];
    }
}
