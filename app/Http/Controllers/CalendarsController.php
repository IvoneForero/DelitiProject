<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calendars;

class CalendarsController extends Controller
{
    //
    public function index(Request $request)
    {
        $calendar = calendars::get();

        return ['calendar'=>$calendar];
    }

    public function getData(Request $request)
    {
        $buscar=$request->idBuscar;

        if ($buscar=='') {
            $calendar = calendars::select('schedule')->get();
        }else{
            $calendar = calendars::select('schedule')->where('id','=',$buscar)->get();
        }
        return ['calendar'=>$calendar];
    }

    public function store(Request $request)
    {
        $calendar = new calendars;
        $calendar->schedule = $request->schedule;
        $calendar->state = $request->state;
        $calendar->save();
    }

    public function update(Request $request)
    {
        $calendar = calendars::find($request->id);
        $calendar->schedule = $request->schedule;
        $calendar->state = $request->state;
        $calendar->save();
    }

    public function destroy(Request $request)
    {
        $calendar = calendars::findOrFail($request->id);
        $calendar->delete();
    }


}
