<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calendars;
use Inertia\Inertia;

class CalendarsController extends Controller
{
    //
    public function index(Request $request)
    {
        $calendar = calendars::get();
        return Inertia::render('Agenda',['calendar'=>$calendar]);

        //return ['calendar'=>$calendar];
    }

    public function index2(Request $request)
    {
        $calendar = calendars::get();
        return ['calendar'=>$calendar];
    }

    public function getData(Request $request)
    {
        $calendar = calendars::select('id','schedule')->get();
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
