<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use App\Models\ord_details;
use App\Models\deliveries;
use Carbon\Carbon;
use Inertia\Inertia;

class OrdersController extends Controller
{
    //
    public function index(Request $request)
    {
        $reg = orders::get();
        return Inertia::render('Pedido',['consulta'=>$reg]);
    }

    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $reg = orders::select('order_date')->get();
        }else{
            $reg = orders::select('order_date')->where('id','=',$buscar)->get();
        }
        return ['order_date'=>$reg];
    }

    public function store(Request $request)
    {
        try 
        {
            DB::beginTransaction();
            $date=Carbon::now()->format('Y-m-d');
            $reg = new orders;

            $reg->order_date = $date;
            $reg->id_client = $request->idClient;
            $reg->deliv_adrress = $request->delivAdrress;
            $reg->delivery_date = date('Y-m-d' , strtotime($request->deliveryDate));
            $reg->id_calendar = $request->idCalendar;
            $reg->receive_name = $request->receiveName;
            $reg->total = $request->total;
            $reg->paid = $request->paid;
            $reg->state = $request->state;

            $reg->save();

            $det=$request->arrayDetails;

            foreach($det as $item=>$detail)
            {
                $detDetails = new ord_details;

                $detDetails->id_order=$reg->id;
                $detDetails->product_code=$detail['prod'];
                $detDetails->units=$detail['units'];
                $detDetails->unit_price=$detail['unitPrice'];
                $detDetails->total=$detail['units']*$detail['unitPrice'];
                $detDetails->save();
            }

            DB::Commit();


        } catch (Exception $e) 
        {
            DB::rollback();
        }

    }

    public function update(Request $request)
    {
        $reg = orders::find($request->id);
        $reg->order_date = date('Y-m-d' , strtotime($request->ordDate));
        $reg->id_client = $request->idClient;
        $reg->deliv_adrress = $request->delivAdrress;
        $reg->delivery_date = date('Y-m-d' , strtotime($request->deliveryDate));
        $reg->id_calendar = $request->idCalendar;
        $reg->receive_name = $request->receiveName;
        $reg->total = $request->total;
        $reg->paid = $request->paid;
        $reg->state = $request->state;
        $reg->save();
    }

    public function destroy(Request $request)
    {
        try 
        {
            DB::beginTransaction();
            $deletedRows = deliveries::where('id_order', $request->id)->delete();

            $deletedRows = ord_details::where('id_order', $request->id)->delete();
    
            $reg = orders::findOrFail($request->id);
            $reg->delete();
            DB::Commit();
        } catch (Exception $e) 
        {
            DB::rollback();
        }
    }
}
