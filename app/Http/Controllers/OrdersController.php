<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\orders;
use App\Models\ord_details;


class OrdersController extends Controller
{
    //
    public function store(Request $request)
    {
        try 
        {
            DB::beginTransaction();
            $reg = new orders;

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

            $det=$request->arrayDetails;

            foreach($det as $item=>$detail)
            {
                $detDetails = new ord_details;

                $detDetails->id_order=$reg->id;
                $detDetails->product_code=$detail['prod'];
                $detDetails->units=$detail['units'];
                $detDetails->unit_price=$detail['unitPrice'];
                #$detDetails->total=int($detail['units'])*int($detail['units']);
                $detDetails->total=500;

                $detDetails->save();
            }

            DB::Commit();


        } catch (Exception $e) 
        {
            DB::rollback();
        }

    }
}
